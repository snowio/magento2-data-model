<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\FamilyAttributeData;

class FamilyAttributeDataTest extends TestCase
{

    public function testToJson()
    {
        $attributeSet = FamilyAttributeData::of('size', 1);
        self::assertEquals([
            'attribute_code' => 'size',
            'sort_order' => 1
        ], $attributeSet->toJson());
    }

    public function testWithers()
    {
        $attributeSet = FamilyAttributeData::of('size', 1)->withSortOrder(5);
        self::assertEquals(5, $attributeSet->getSortOrder());
        self::assertEquals('size', $attributeSet->getCode());
    }

    public function testEquals()
    {
        $attributeSet = FamilyAttributeData::of('size', 1);
        self::assertTrue(FamilyAttributeData::of('size', 1)->equals($attributeSet));
        self::assertFalse(FamilyAttributeData::of('size', 2)->equals($attributeSet));
        self::assertFalse(FamilyAttributeData::of('color', 5)->equals($attributeSet));
        self::assertFalse(FamilyAttributeData::of('color', 5)->equals(AttributeData::of('color', 'Color', 'Color')));
    }

}