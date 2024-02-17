<?php

declare(strict_types=1);

namespace App\V1\Core\Domain\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

class HttpException extends SymfonyHttpException
{
    public function __construct(
        string $message = '',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        \Throwable $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
