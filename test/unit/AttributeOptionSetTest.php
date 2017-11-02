<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\AttributeOptionSet;
use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;
use SnowIO\Magento2DataModel\Command\SaveAttributeOptionCommand;

class AttributeOptionSetTest extends TestCase 
{
    use CommandHelper;

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

    public function testMapToSaveCommand()
    {
        $attributeOptionSet = AttributeOptionSet::of([
            AttributeOption::of('size', 'large', 'Large'),
            AttributeOption::of('color', 'blue', 'Blue'),
        ]);

        $expectedCommands = [
            'size large' => SaveAttributeOptionCommand::of(AttributeOption::of('size', 'large',
                'Large'))->withTimestamp(1509613892),
            'color blue' => SaveAttributeOptionCommand::of(AttributeOption::of('color', 'blue',
                'Blue'))->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedCommands),
            $this->getJson($attributeOptionSet->mapToSaveCommands(1509613892)));
    }

    public function testMapToDeleteCommand()
    {
        $attributeOptionSet = AttributeOptionSet::of([
            AttributeOption::of('size', 'large', 'Large'),
            AttributeOption::of('color', 'blue', 'Blue'),
        ]);

        $expectedCommands = [
            'size large' => DeleteAttributeOptionCommand::of('size', 'large')->withTimestamp(1509613892),
            'color blue' => DeleteAttributeOptionCommand::of('color', 'blue')->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedCommands),
            $this->getJson($attributeOptionSet->mapToDeleteCommands(1509613892)));
    }
}