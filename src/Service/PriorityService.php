<?php

declare(strict_types=1);

namespace App\Service;

final class PriorityService
{
    public function shouldBeHighPriority(int $priority): bool
    {
        return $priority > 0 && $priority < 3;
    }
}
