<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;


use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\FamilyAttributeData;
use SnowIO\Magento2DataModel\FamilyAttributeDataSet;

class FamilyAttributeDataSetTest extends TestCase
{
    public function testWithers()
    {
        $familyAttributeDataSet = FamilyAttributeDataSet::of([
            FamilyAttributeData::of('size', 1),
            FamilyAttributeData::of('color', 3),
            FamilyAttributeData::of('density', 1),
        ]);

        $familyAttributeDataSet = $familyAttributeDataSet->with(FamilyAttributeData::of('volume', 10));
        self::assertTrue($familyAttributeDataSet->equals(FamilyAttributeDataSet::of([
            FamilyAttributeData::of('size', 1),
            FamilyAttributeData::of('color', 3),
            FamilyAttributeData::of('density', 1),
            FamilyAttributeData::of('volume', 10),
        ])));

        $familyAttributeDataSet = $familyAttributeDataSet->with(FamilyAttributeData::of('volume', 2));
        self::assertTrue($familyAttributeDataSet->equals(FamilyAttributeDataSet::of([
            FamilyAttributeData::of('size', 1),
            FamilyAttributeData::of('color', 3),
            FamilyAttributeData::of('density', 1),
            FamilyAttributeData::of('volume', 2),
        ])));
    }

    public function testToJson()
    {
        $familyAttributeDataSet = FamilyAttributeDataSet::of([
            FamilyAttributeData::of('size', 1),
            FamilyAttributeData::of('density', 1),
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
        ], $familyAttributeDataSet->toJson());
    }

}