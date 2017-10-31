<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSetCode;
use SnowIO\Magento2DataModel\CustomAttribute;

class AttributeSetCodeTest extends TestCase
{

    public function testToJson()
    {
        $attributeSetCode = AttributeSetCode::of('general');
        self::assertEquals([
            'attribute_set_code' => 'general'
        ], $attributeSetCode->toJson());
    }

    public function testAccessors()
    {
        $attributeSetCode = AttributeSetCode::of('general');
        self::assertEquals('attribute_set_code', $attributeSetCode->getCode());
        self::assertEquals('general', $attributeSetCode->getValue());
    }

    public function testEquals()
    {
        $attributeSetCode = AttributeSetCode::of('general');
        self::assertTrue(AttributeSetCode::of('general')->equals($attributeSetCode));
        self::assertFalse(AttributeSetCode::of('default')->equals($attributeSetCode));
        self::assertFalse(CustomAttribute::of('default_group', 'general')->equals($attributeSetCode));
    }
}
