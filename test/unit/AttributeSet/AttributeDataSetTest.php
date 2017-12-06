<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\AttributeSet;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSet\AttributeData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeDataSet;

class AttributeDataSetTest extends TestCase
{
    public function testWithers()
    {
        $attributeDataSet = AttributeDataSet::of([
            AttributeData::of('size')->withSortOrder(1),
            AttributeData::of('color')->withSortOrder(3),
            AttributeData::of('density')->withSortOrder(1),
        ]);

        $attributeDataSet = $attributeDataSet->with(AttributeData::of('volume')->withSortOrder(10));
        self::assertTrue($attributeDataSet->equals(AttributeDataSet::of([
            AttributeData::of('size')->withSortOrder(1),
            AttributeData::of('color')->withSortOrder(3),
            AttributeData::of('density')->withSortOrder(1),
            AttributeData::of('volume')->withSortOrder(10),
        ])));

        $attributeDataSet = $attributeDataSet->with(AttributeData::of('volume'));
        self::assertTrue($attributeDataSet->equals(AttributeDataSet::of([
            AttributeData::of('size')->withSortOrder(1),
            AttributeData::of('color')->withSortOrder(3),
            AttributeData::of('density')->withSortOrder(1),
            AttributeData::of('volume'),
        ])));
    }

    public function testToJson()
    {
        $attributeDataSet = AttributeDataSet::of([
            AttributeData::of('size')->withSortOrder(1),
            AttributeData::of('density')->withSortOrder(1),
        ]);

        self::assertEquals([
            [
                'attribute_code' => 'size',
                'sort_order' => 1,
            ],
            [
                'attribute_code' => 'density',
                'sort_order' => 1,
            ]
        ], $attributeDataSet->toJson());
    }
}
