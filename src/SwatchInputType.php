<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class SwatchInputType
{
    const VISUAL = 'visual';
    const TEXT = 'text';
    const DROPDOWN = 'dropdown';

    const ALL = [
        self::VISUAL,
        self::TEXT,
        self::DROPDOWN,
    ];

    public static function validateType(string $type)
    {
        if (!in_array($type, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Input Type');
        }
    }

    private function __construct()
    {

    }
}
