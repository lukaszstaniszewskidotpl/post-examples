<?php

declare(strict_types=1);

namespace App\Util;

use DateTime;
use DateTimeZone;
use Symfony\Component\HttpFoundation\Response;

trait DateTimeResponseTrait
{
    private function generateResponse(): Response
    {
        return new Response(
            $this->generateDateTime()
        );
    }

    private function generateDateTime(): string
    {
        return (new DateTime())
            ->setTimezone(new DateTimeZone('Europe/Warsaw'))
            ->format('Y-m-d H:i:s:v')
        ;
    }
}
