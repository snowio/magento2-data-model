<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupDataSet;
use SnowIO\Magento2DataModel\AttributeSetData;
use SnowIO\Magento2DataModel\EntityTypeCode;
use SnowIO\Magento2DataModel\AttributeSet\AttributeData;

class AttributeSetTest extends TestCase
{
    public function testToJson()
    {
        $attributeSet = AttributeSetData::of(EntityTypeCode::PRODUCT, 'default', 'Default');
        self::assertEquals([
            'attribute_set_code' => 'default',
            'name' => 'Default',
            'entity_type_code' => 'catalog_product',
            'attribute_groups' => [],
        ], $attributeSet->toJson());
    }

    public function testWithers()
    {
        /** @var AttributeSetData $attributeSet */
        $attributeSet = AttributeSetData::of(EntityTypeCode::PRODUCT, 'default', 'Default')
            ->withAttributeGroups(AttributeGroupDataSet::of([
                AttributeGroupData::of('user_statistics', 'User Statistics')
            ]))
            ->withAttributeGroup(AttributeGroupData::of('measures', 'Measures'))
            ->withAttributeGroup(AttributeGroupData::of('quality_bands', 'Quality Bands'))
            ->withName('Default Group');

        self::assertEquals('default', $attributeSet->getCode());
        self::assertEquals('Default Group', $attributeSet->getName());
        self::assertTrue(AttributeGroupDataSet::of([
            AttributeGroupData::of('measures', 'Measures'),
            AttributeGroupData::of('quality_bands', 'Quality Bands'),
            AttributeGroupData::of('user_statistics', 'User Statistics'),
        ])->equals($attributeSet->getAttributeGroups()));
        self::assertEquals(EntityTypeCode::PRODUCT, $attributeSet->getEntityTypeCode());
    }

    public function testEquals()
    {
        /** @var AttributeSetData $attributeSet */
        $attributeSet = AttributeSetData::of(EntityTypeCode::PRODUCT, 'default', 'Default')
            ->withAttributeGroups(AttributeGroupDataSet::of([
                AttributeGroupData::of('user_statistics', 'User Statistics')
            ]))
            ->withAttributeGroup(
                AttributeGroupData::of('measures', 'Measures')
                    ->withAttribute(AttributeData::of('size')));

        $otherAttributeSet = clone $attributeSet;
        self::assertTrue($otherAttributeSet->equals($attributeSet));
        self::assertFalse($otherAttributeSet->withAttributeGroup(AttributeGroupData::of('measures', 'Measures')
            ->withAttribute(AttributeData::of('volume')))->equals($attributeSet));
        self::assertFalse(($otherAttributeSet->withName('Default Group'))->equals($attributeSet));
        self::assertFalse((AttributeGroupData::of('size', 'Size'))->equals($attributeSet));
    }
}
