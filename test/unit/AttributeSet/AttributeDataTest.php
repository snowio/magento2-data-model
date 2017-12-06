<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\AttributeSet;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSet\AttributeData;

class AttributeDataTest extends TestCase
{
    public function testToJson()
    {
        $attribute = AttributeData::of('size');
        self::assertEquals([
            'attribute_code' => 'size',
            'sort_order' => 1,
        ], $attribute->toJson());
    }

    public function testWithers()
    {
        $attributeSet = AttributeData::of('size')->withSortOrder(5);
        self::assertEquals(5, $attributeSet->getSortOrder());
        self::assertEquals('size', $attributeSet->getCode());
    }

    public function testEquals()
    {
        $attribute = AttributeData::of('size')->withSortOrder(1);
        self::assertTrue(AttributeData::of('size')->withSortOrder(1)->equals($attribute));
        self::assertFalse(AttributeData::of('size')->withSortOrder(2)->equals($attribute));
        self::assertFalse(AttributeData::of('color')->withSortOrder(5)->equals($attribute));
        self::assertFalse(AttributeData::of('color')->withSortOrder(5)->equals(AttributeData::of('color')));
    }
}
