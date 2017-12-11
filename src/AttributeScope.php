<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeScope
{
    const STORE = 'store';
    const WEBSITE = 'website';
    const GLOBAL = 'global';

    const ALL = [
        self::STORE,
        self::WEBSITE,
        self::GLOBAL,
    ];

    public static function validateScope(string $scope)
    {
        if (!in_array($scope, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Scope');
        }
    }

    private function __construct()
    {

    }
}
