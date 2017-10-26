<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

class ProductStatus
{
    const ENABLED = 1;
    const DISABLED = 2;

    const ALL = [
        self::ENABLED,
        self::DISABLED
    ];

    public static function validateStatus(int $status)
    {
        if (!in_array($status, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Status');
        }
    }
}
