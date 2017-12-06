<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\AttributeSet;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupData;
use SnowIO\Magento2DataModel\AttributeSetData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeDataSet;
use SnowIO\Magento2DataModel\EntityTypeCode;

class AttributeGroupTest extends TestCase
{
    public function testToJson()
    {
        $attributeGroup = AttributeGroupData::of('measures', 'Measures');
        self::assertEquals([
            'attribute_group_code' => 'measures',
            'name' => 'Measures',
            'sort_order' => 1,
            'attributes' => []
        ], $attributeGroup->toJson());
    }

    public function testWithers()
    {
        $attributeGroup = AttributeGroupData::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(AttributeDataSet::of([
                AttributeData::of('size')->withSortOrder(1),
                AttributeData::of('color')->withSortOrder(3),
                AttributeData::of('density')->withSortOrder(1),
            ]))->withAttribute(AttributeData::of('volume')->withSortOrder(19));

        self::assertTrue(AttributeDataSet::of([
            AttributeData::of('size')->withSortOrder(1),
            AttributeData::of('color')->withSortOrder(3),
            AttributeData::of('density')->withSortOrder(1),
            AttributeData::of('volume')->withSortOrder(19)
        ])->equals($attributeGroup->getAttributes()));
        self::assertEquals('measures', $attributeGroup->getCode());
        self::assertEquals('Edited Measures', $attributeGroup->getName());
        self::assertEquals(5, $attributeGroup->getSortOrder());
    }

    public function testEquals()
    {
        $attributeGroup = AttributeGroupData::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(AttributeDataSet::of([
                AttributeData::of('size')->withSortOrder(1),
                AttributeData::of('color')->withSortOrder(3),
                AttributeData::of('density')->withSortOrder(1),
            ]))->withAttribute(AttributeData::of('volume')->withSortOrder(19));

        self::assertTrue(AttributeGroupData::of('measures', 'Measures')
            ->withName("Edited Measures")
            ->withSortOrder(5)
            ->withAttributes(AttributeDataSet::of([
                AttributeData::of('size')->withSortOrder(1),
                AttributeData::of('color')->withSortOrder(3),
                AttributeData::of('density')->withSortOrder(1),
            ]))->withAttribute(AttributeData::of('volume')->withSortOrder(19))->equals($attributeGroup));
        $otherAttributeGroup = clone $attributeGroup;
        self::assertFalse($otherAttributeGroup->withSortOrder(8)->equals($attributeGroup));
        self::assertFalse(
            $otherAttributeGroup
                ->withAttribute(AttributeData::of('depth')->withSortOrder(1))
                ->equals($attributeGroup)
        );
        self::assertFalse($otherAttributeGroup->withName('Bar')->equals($attributeGroup));
        self::assertFalse(AttributeSetData::of(EntityTypeCode::PRODUCT, 'foo', 'bar')->equals($attributeGroup));
    }
}
