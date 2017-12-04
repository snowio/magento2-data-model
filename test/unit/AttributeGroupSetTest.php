<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeGroup;
use SnowIO\Magento2DataModel\AttributeGroupSet;

class AttributeGroupSetTest extends TestCase
{
    public function testWithers()
    {
        $attributeGroupSet = AttributeGroupSet::of([
            AttributeGroup::of('measures', 'Mearsures'),
            AttributeGroup::of('ratings', 'Ratings'),
            AttributeGroup::of('operating_metrics', 'Operating Metrics'),
        ]);

        $attributeGroupSet = $attributeGroupSet->with(AttributeGroup::of('user_stats', 'User Statistics'));
        self::assertTrue(AttributeGroupSet::of([
            AttributeGroup::of('measures', 'Mearsures'),
            AttributeGroup::of('ratings', 'Ratings'),
            AttributeGroup::of('operating_metrics', 'Operating Metrics'),
            AttributeGroup::of('user_stats', 'User Statistics'),
        ])->equals($attributeGroupSet));

        $attributeGroupSet = $attributeGroupSet->with(AttributeGroup::of('user_stats', 'User Stats'));
        self::assertTrue(AttributeGroupSet::of([
            AttributeGroup::of('measures', 'Mearsures'),
            AttributeGroup::of('ratings', 'Ratings'),
            AttributeGroup::of('operating_metrics', 'Operating Metrics'),
            AttributeGroup::of('user_stats', 'User Stats'),
        ])->equals($attributeGroupSet));
    }

    public function testToJson()
    {
        $attributeGroupSet = AttributeGroupSet::of([
            AttributeGroup::of('measures', 'Measures'),
            AttributeGroup::of('ratings', 'Ratings'),
        ]);

        self::assertEquals([
            [
                'attribute_group_code' => 'measures',
                'name' => 'Measures',
                'sort_order' => 1,
                'attributes' => []
            ],
            [
                'attribute_group_code' => 'ratings',
                'name' => 'Ratings',
                'sort_order' => 1,
                'attributes' => []
            ],
        ], $attributeGroupSet->toJson());
    }
}
