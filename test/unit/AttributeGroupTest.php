<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeGroup;
use SnowIO\Magento2DataModel\AttributeSet;
use SnowIO\Magento2DataModel\FamilyAttributeData;
use SnowIO\Magento2DataModel\FamilyAttributeDataSet;

class AttributeGroupTest extends TestCase
{
    public function testToJson()
    {
        $attributeGroup = AttributeGroup::of('measures', 'Measures');
        self::assertEquals([
            'attribute_group_code' => 'measures',
            'name' => 'Measures',
            'sort_order' => 1,
            'attributes' => []
        ], $attributeGroup->toJson());
    }

    public function testWithers()
    {
        $attributeGroup = AttributeGroup::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(FamilyAttributeDataSet::of([
                FamilyAttributeData::of('size', 1),
                FamilyAttributeData::of('color', 3),
                FamilyAttributeData::of('density', 1),
            ]))->withAttribute(FamilyAttributeData::of('volume', 19));

        self::assertTrue(FamilyAttributeDataSet::of([
            FamilyAttributeData::of('size', 1),
            FamilyAttributeData::of('color', 3),
            FamilyAttributeData::of('density', 1),
            FamilyAttributeData::of('volume', 19)
        ])->equals($attributeGroup->getAttributes()));
        self::assertEquals('measures', $attributeGroup->getCode());
        self::assertEquals('Edited Measures', $attributeGroup->getName());
        self::assertEquals(5, $attributeGroup->getSortOrder());
    }

    public function testEquals()
    {
        $attributeGroup = AttributeGroup::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(FamilyAttributeDataSet::of([
                FamilyAttributeData::of('size', 1),
                FamilyAttributeData::of('color', 3),
                FamilyAttributeData::of('density', 1),
            ]))->withAttribute(FamilyAttributeData::of('volume', 19));

        self::assertTrue(AttributeGroup::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(FamilyAttributeDataSet::of([
                FamilyAttributeData::of('size', 1),
                FamilyAttributeData::of('color', 3),
                FamilyAttributeData::of('density', 1),
            ]))->withAttribute(FamilyAttributeData::of('volume', 19))->equals($attributeGroup));
        $otherAttributeGroup = clone $attributeGroup;
        self::assertFalse($otherAttributeGroup->withSortOrder(8)->equals($attributeGroup));
        self::assertFalse($otherAttributeGroup->withAttribute(FamilyAttributeData::of('depth',
            1))->equals($attributeGroup));
        self::assertFalse($otherAttributeGroup->withName('Bar')->equals($attributeGroup));
        self::assertFalse(AttributeSet::of('foo', 'bar')->equals($attributeGroup));
    }
}