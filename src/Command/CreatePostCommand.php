<?php

namespace App\Command;

final class CreatePostCommand
{
    public function __construct(private string $title)
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
