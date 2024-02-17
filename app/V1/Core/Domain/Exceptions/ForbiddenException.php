<?php

declare(strict_types=1);

namespace App\V1\Core\Domain\Exceptions;

use App\V1\Core\Domain\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends HttpException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_FORBIDDEN;
    }
}
