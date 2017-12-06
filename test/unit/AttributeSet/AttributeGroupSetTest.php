<?php
namespace SnowIO\Magento2DataModel\Test\AttributeSet;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupDataSet;

class AttributeGroupSetTest extends TestCase
{
    public function testWithers()
    {
        $attributeGroupSet = AttributeGroupDataSet::of([
            AttributeGroupData::of('measures', 'Mearsures'),
            AttributeGroupData::of('ratings', 'Ratings'),
            AttributeGroupData::of('operating_metrics', 'Operating Metrics'),
        ]);

        $attributeGroupSet = $attributeGroupSet->with(AttributeGroupData::of('user_stats', 'User Statistics'));
        self::assertTrue(AttributeGroupDataSet::of([
            AttributeGroupData::of('measures', 'Mearsures'),
            AttributeGroupData::of('ratings', 'Ratings'),
            AttributeGroupData::of('operating_metrics', 'Operating Metrics'),
            AttributeGroupData::of('user_stats', 'User Statistics'),
        ])->equals($attributeGroupSet));

        $attributeGroupSet = $attributeGroupSet->with(AttributeGroupData::of('user_stats', 'User Stats'));
        self::assertTrue(AttributeGroupDataSet::of([
            AttributeGroupData::of('measures', 'Mearsures'),
            AttributeGroupData::of('ratings', 'Ratings'),
            AttributeGroupData::of('operating_metrics', 'Operating Metrics'),
            AttributeGroupData::of('user_stats', 'User Stats'),
        ])->equals($attributeGroupSet));
    }

    public function testToJson()
    {
        $attributeGroupSet = AttributeGroupDataSet::of([
            AttributeGroupData::of('measures', 'Measures'),
            AttributeGroupData::of('ratings', 'Ratings'),
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
