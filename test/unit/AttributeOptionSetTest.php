<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\AttributeOptionSet;

class AttributeOptionSetTest extends TestCase 
{
    public function testWither()
    {
        $attributeOptionSet = AttributeOptionSet::of([
            AttributeOption::of('size', 'large', 'Large'),
            AttributeOption::of('color', 'blue', 'Blue'),
            AttributeOption::of('material', 'mahogany', 'Mahogany'),
            AttributeOption::of('grade', 'b', 'B-Stock'),
        ]);

        $attributeOptionSet = $attributeOptionSet->with(AttributeOption::of('terrain', 'woodland', 'Woodland'));
        self::assertTrue($attributeOptionSet->equals(AttributeOptionSet::of([
            AttributeOption::of('size', 'large', 'Large'),
            AttributeOption::of('color', 'blue', 'Blue'),
            AttributeOption::of('material', 'mahogany', 'Mahogany'),
            AttributeOption::of('grade', 'b', 'B-Stock'),
            AttributeOption::of('terrain', 'woodland', 'Woodland'),
        ])));

        $attributeOptionSet = $attributeOptionSet->with(AttributeOption::of('terrain', 'tundra', 'Tundra'));
        self::assertTrue($attributeOptionSet->equals(AttributeOptionSet::of([
            AttributeOption::of('size', 'large', 'Large'),
            AttributeOption::of('color', 'blue', 'Blue'),
            AttributeOption::of('material', 'mahogany', 'Mahogany'),
            AttributeOption::of('grade', 'b', 'B-Stock'),
            //todo discussion about this test case.
            AttributeOption::of('terrain', 'tundra', 'Tundra'),
            AttributeOption::of('terrain', 'woodland', 'Woodland'),
        ])));
    }
}