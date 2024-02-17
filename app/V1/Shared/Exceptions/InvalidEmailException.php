<?php

declare(strict_types=1);

namespace App\V1\Shared\Exceptions;

use App\V1\Core\Domain\Exceptions\DomainException;

class InvalidEmailException extends DomainException
{
}
