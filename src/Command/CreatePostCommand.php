<?php

namespace App\Command;

final class CreatePostCommand
{
    public function __construct(private readonly string $uuid, private readonly string $title)
    {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
