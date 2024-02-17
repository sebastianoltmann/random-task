<?php

declare(strict_types=1);

namespace App\V1\Core\Domain\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        RouteNotFoundException::class,
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

    /**
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse
    {
        if (request()?->expectsJson()) {
            if ($e instanceof ThrottleRequestsException) {
                return new JsonResponse(
                    data: ['message' => __('core::validation.throttle')],
                    status: Response::HTTP_TOO_MANY_REQUESTS,
                    options: JSON_UNESCAPED_UNICODE
                );
            }

            if ($e instanceof ValidationException) {
                return new JsonResponse(
                    data: [
                        'message' => __('core::validation.invalid_data'),
                        'errors' => $e->errors(),
                    ],
                    status: $e->status,
                    options: JSON_UNESCAPED_UNICODE
                );
            }

            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return new JsonResponse(
                    data: ['message' => __('core::domain.model_not_found')],
                    status: Response::HTTP_NOT_FOUND,
                    options: JSON_UNESCAPED_UNICODE
                );
            }
        }

        return parent::render($request, $e);
    }

    protected function unauthenticated(
        $request,
        AuthenticationException $exception
    ): JsonResponse|Response|RedirectResponse {
        return new JsonResponse([
            'message' => __('core::domain.unauthenticated'),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
