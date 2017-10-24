<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;

class CustomAttributeSetTest extends TestCase
{
    public function testInitialisation()
    {
        $customAttributeSet = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        $getJson = function (CustomAttribute $customAttribute) {
            return $customAttribute->toJson();
        };

        self::assertEquals([
            [
                'attribute_code' => 'diameter',
                'value' => '900'
            ],
            [
                'attribute_code' => 'volume',
                'value' => '90'
            ],
            [
                'attribute_code' => 'density',
                'value' => '40'
            ],
        ], array_map($getJson, iterator_to_array($customAttributeSet)));

    }
}