<?php
namespace SnowIO\Magento2DataModel;

class ProductStatus
{
    const ENABLED = 1;
    const DISABLED = 0;

    const ALL = [
        self::ENABLED,
        self::DISABLED
    ];

    public static function validateStatus(int $status)
    {
        $validStatuses = self::ALL;

        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid Status');
        }
    }
}
