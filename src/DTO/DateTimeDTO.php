<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class DateTimeDTO
{
    #[Assert\NotBlank]
    public ?string $raw;
}
