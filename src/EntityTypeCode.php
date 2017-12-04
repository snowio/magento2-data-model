<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class EntityTypeCode
{
    const CATALOG_CATEGORY = 'catalog_category';
    const CATALOG_PRODUCT = 'catalog_product';

    const ALL = [
        self::CATALOG_CATEGORY,
        self::CATALOG_PRODUCT,
    ];

    public static function validateEntityTypeCode(string $entityTypeCode)
    {
        if (!in_array($entityTypeCode, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Entity Type Code');
        }
    }

}