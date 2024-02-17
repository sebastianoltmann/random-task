<?php

declare(strict_types=1);

namespace App\V1\Shared\VO;

use App\V1\Shared\Exceptions\InvalidEmailException;
use JsonSerializable;

final class EmailVO implements JsonSerializable
{
    private const AT = '@';

    private string $value;
    
    public function __construct(string $email)
    {
        $this->value = $email;
        $this->validate();
    }

    private function validate(): void
    {
        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function jsonSerialize(): string
    {
        return $this->value();
    }
}
