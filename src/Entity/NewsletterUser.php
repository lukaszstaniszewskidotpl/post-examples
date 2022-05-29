<?php

declare(strict_types=1);

namespace App\Entity;

class NewsletterUser
{
    public function __construct(private readonly string $email)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
