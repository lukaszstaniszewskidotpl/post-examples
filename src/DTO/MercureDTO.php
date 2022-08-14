<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enum\ProductStatus;

class MercureDTO
{
    public ?ProductStatus $status;

    public ?int $productId;
}
