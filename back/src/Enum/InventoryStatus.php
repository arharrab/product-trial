<?php

namespace App\Enum;

enum InventoryStatus: string
{
    case INSTOCK = 'INSTOCK';
    case LOWSTOCK = 'LOWSTOCK';
    case OUTOFSTOCK = 'OUTOFSTOCK';

    public function label(): string
    {
        return match($this) {
            self::INSTOCK => 'In Stock',
            self::LOWSTOCK => 'Low Stock',
            self::OUTOFSTOCK => 'Out of Stock',
        };
    }
}
