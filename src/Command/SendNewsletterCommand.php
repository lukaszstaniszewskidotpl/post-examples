<?php

declare(strict_types=1);

namespace App\Command;

class SendNewsletterCommand
{
    public function __construct(private string $postUuid)
    {
    }

    public function getPostUuid(): string
    {
        return $this->postUuid;
    }
}
