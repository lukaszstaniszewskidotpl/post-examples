<?php

declare(strict_types=1);

namespace App\Enum;

enum ProductStatus: string
{
    case IN_STOCK = 'InStock';

    case OUT_OF_STOCK = 'OutOfStock';

    case PREORDER = 'Preorder';
}
