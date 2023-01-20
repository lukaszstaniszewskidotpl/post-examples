<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\PriorityService;
use PHPUnit\Framework\TestCase;

class PriorityServiceTest extends TestCase
{
    private PriorityService $service;

    protected function setUp(): void
    {
        $this->service = new PriorityService();
    }

    /**
     * @test
     * @dataProvider getHighPriority
     */
    public function shouldBeReturnHighPriority(int $priority): void
    {
        self::assertTrue(
            $this->service->shouldBeHighPriority($priority)
        );
    }

    public function getHighPriority(): array
    {
        return array_map(
            static fn (int $priority) => [$priority],
            range(1, 2)
        );
    }

    /**
     * @dataProvider getAnotherPriority
     * @test
     */
    public function shouldBeReturnAnotherPriority(int $priority): void
    {
        self::assertFalse(
            $this->service->shouldBeHighPriority($priority)
        );
    }

    public function getAnotherPriority(): array
    {
        return array_map(
            static fn (int $priority) => [$priority],
            [0, -1, 3, 4]
        );
    }
}

