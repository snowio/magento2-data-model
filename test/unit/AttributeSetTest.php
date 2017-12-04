<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeGroup;
use SnowIO\Magento2DataModel\AttributeGroupSet;
use SnowIO\Magento2DataModel\AttributeSet;
use SnowIO\Magento2DataModel\EntityTypeCode;
use SnowIO\Magento2DataModel\FamilyAttributeData;

class AttributeSetTest extends TestCase
{
    public function testToJson()
    {
        $attributeSet = AttributeSet::of('default', 'Default');
        self::assertEquals([
            'attribute_set_code' => 'default',
            'name' => 'Default',
            'entity_type_code' => 'catalog_product',
            'attribute_groups' => [],
        ], $attributeSet->toJson());
    }

    public function testWithers()
    {
        /** @var AttributeSet $attributeSet */
        $attributeSet = AttributeSet::of('default', 'Default')
            ->withAttributeGroups(AttributeGroupSet::of([
                AttributeGroup::of('user_statistics', 'User Statistics')
            ]))
            ->withEntityTypeCode(EntityTypeCode::CATALOG_PRODUCT)
            ->withAttributeGroup(AttributeGroup::of('measures', 'Measures'))
            ->withAttributeGroup(AttributeGroup::of('quality_bands', 'Quality Bands'))
            ->withName('Default Group');

        self::assertEquals('default', $attributeSet->getCode());
        self::assertEquals('Default Group', $attributeSet->getName());
        self::assertTrue(AttributeGroupSet::of([
            AttributeGroup::of('measures', 'Measures'),
            AttributeGroup::of('quality_bands', 'Quality Bands'),
            AttributeGroup::of('user_statistics', 'User Statistics'),
        ])->equals($attributeSet->getAttributeGroups()));
        self::assertEquals(EntityTypeCode::CATALOG_PRODUCT, $attributeSet->getEntityTypeCode());
    }

    public function testEquals()
    {
        /** @var AttributeSet $attributeSet */
        $attributeSet = AttributeSet::of('default', 'Default')
            ->withAttributeGroups(AttributeGroupSet::of([
                AttributeGroup::of('user_statistics', 'User Statistics')
            ]))
            ->withEntityTypeCode(EntityTypeCode::CATALOG_PRODUCT)
            ->withAttributeGroup(
                AttributeGroup::of('measures', 'Measures')
                    ->withAttribute(FamilyAttributeData::of('size', 1)));

        $otherAttributeSet = clone $attributeSet;
        self::assertTrue($otherAttributeSet->equals($attributeSet));
        self::assertFalse($otherAttributeSet->withAttributeGroup(AttributeGroup::of('measures', 'Measures')
            ->withAttribute(FamilyAttributeData::of('volume', 1)))->equals($attributeSet));
        self::assertFalse(($otherAttributeSet->withName('Default Group'))->equals($attributeSet));
        self::assertFalse((AttributeGroup::of('size', 'Size'))->equals($attributeSet));
    }
}