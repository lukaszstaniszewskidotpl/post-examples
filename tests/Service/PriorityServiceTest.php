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
     */
    public function shouldBeReturnHighPriority(): void
    {
        self::assertTrue(
            $this->service->shouldBeHighPriority(2)
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
        return [
            [-100],
            [5],
        ];
    }
}

