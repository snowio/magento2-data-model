<?php
namespace SnowIO\Magento2DataModel;

class ProductTypeId
{
    const SIMPLE = 'simple';
    const GROUPED = 'grouped';
    const CONFIGURABLE = 'configurable';
    const VIRTUAL = 'virtual';
    const BUNDLE = 'bundle';
    const DOWNLOADABLE = 'downloadable';

    const ALL = [
        self::SIMPLE,
        self::GROUPED,
        self::CONFIGURABLE,
        self::VIRTUAL,
        self::BUNDLE,
        self::DOWNLOADABLE,
    ];

    public static function validateTypeId(string $typeId)
    {
        if (!in_array($typeId, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Type Id');
        }
    }
}
