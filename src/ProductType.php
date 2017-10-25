<?php
namespace SnowIO\Magento2DataModel;

class ProductType
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

    public static function validateVisibility(int $visibility)
    {
        $validVisibilities = self::ALL;

        if (!in_array($visibility, $validVisibilities)) {
            throw new \InvalidArgumentException('Invalid Visibility');
        }
    }
}
