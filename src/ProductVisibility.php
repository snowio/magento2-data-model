<?php
namespace SnowIO\Magento2DataModel;

class ProductVisibility
{
    const CATALOG = 2;
    const SEARCH = 3;
    const CATALOG_SEARCH = 4;
    const NOT_VISIBLE_INDIVIDUALLY = 1;

    const ALL = [
        self::NOT_VISIBLE_INDIVIDUALLY,
        self::CATALOG,
        self::SEARCH,
        self::CATALOG_SEARCH
    ];

    public static function validateVisibility(int $visibility)
    {
        if (!in_array($visibility, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Visibility');
        }
    }
}
