<?php

declare(strict_types=1);

namespace App\Service;

class ValidatorService
{
    public function __construct(private readonly array $errors)
    {
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }
}
