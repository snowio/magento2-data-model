<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\ExtensionAttribute;

class ExtensionAttributeTest extends TestCase
{

    public function testToJson()
    {
        $extensionAttribute = ExtensionAttribute::of('attribute_set_code', 'default');
        self::assertEquals([
            'attribute_set_code' => 'default'
        ], $extensionAttribute->toJson());
    }

    public function testAccessors()
    {
        $extensionAttribute = ExtensionAttribute::of('attribute_set_code', 'default');
        self::assertEquals('default', $extensionAttribute->getValue());
        self::assertEquals('attribute_set_code', $extensionAttribute->getCode());
    }

    public function testEquals()
    {
        $extensionAttribute = ExtensionAttribute::of('attribute_set_code', 'default');
        self::assertTrue($extensionAttribute->equals(ExtensionAttribute::of('attribute_set_code', 'default')));
        self::assertFalse($extensionAttribute->equals(ExtensionAttribute::of('attribute_set_id', 1)));
        self::assertFalse($extensionAttribute->equals(ExtensionAttribute::of('attribute_set_code', 'default2')));
        self::assertFalse($extensionAttribute->equals(CustomAttribute::of('attribute_set_code', 'default')));
    }

    public function testFromJson()
    {
        $extensionAttribute = ExtensionAttribute::of('attribute_set_code', 'default');
        self::assertTrue(ExtensionAttribute::fromJson([
           'attribute_set_code' => 'default'
        ])->equals($extensionAttribute));
    }
}
