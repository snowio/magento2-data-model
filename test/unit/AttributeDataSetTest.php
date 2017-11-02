<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\AttributeDataSet;
use SnowIO\Magento2DataModel\Command\Command;
use SnowIO\Magento2DataModel\Command\DeleteAttributeCommand;
use SnowIO\Magento2DataModel\Command\SaveAttributeCommand;
use SnowIO\Magento2DataModel\FrontendInput;

class AttributeDataSetTest extends TestCase
{
    use CommandHelper;

    public function testWither()
    {
        $attributeDataSet = AttributeDataSet::of([
            AttributeData::of('volume', FrontendInput::TEXT, 'Volume'),
            AttributeData::of('density', FrontendInput::TEXT, 'Density'),
            AttributeData::of('length', FrontendInput::TEXT, 'Length'),
            AttributeData::of('width', FrontendInput::TEXT, 'Width'),
        ]);

        $attributeDataSet = $attributeDataSet->with(AttributeData::of('volume', FrontendInput::TEXT, 'Volume'));
        self::assertTrue($attributeDataSet->equals(AttributeDataSet::of([
            AttributeData::of('volume', FrontendInput::TEXT, 'Volume'),
            AttributeData::of('density', FrontendInput::TEXT, 'Density'),
            AttributeData::of('length', FrontendInput::TEXT, 'Length'),
            AttributeData::of('width', FrontendInput::TEXT, 'Width'),
        ])));

        $attributeDataSet = $attributeDataSet->with(AttributeData::of('volume', FrontendInput::TEXT, 'Volume in m2'));
        self::assertTrue($attributeDataSet->equals(AttributeDataSet::of([
            AttributeData::of('volume', FrontendInput::TEXT, 'Volume in m2'),
            AttributeData::of('density', FrontendInput::TEXT, 'Density'),
            AttributeData::of('length', FrontendInput::TEXT, 'Length'),
            AttributeData::of('width', FrontendInput::TEXT, 'Width'),
        ])));
    }

    public function testMapToSaveCommands()
    {
        $attributeDataSet = AttributeDataSet::of([
            AttributeData::of('volume', FrontendInput::TEXT, 'Volume'),
            AttributeData::of('density', FrontendInput::TEXT, 'Density'),
        ]);

        $expectedCommands = [
            'volume' => SaveAttributeCommand::of(AttributeData::of('volume', FrontendInput::TEXT,
                'Volume'))->withTimestamp(1509613892),
            'density' => SaveAttributeCommand::of(AttributeData::of('density', FrontendInput::TEXT,
                'Density'))->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedCommands),
            $this->getJson($attributeDataSet->mapToSaveCommands(1509613892)));
    }

    public function testMapToDeleteCommands()
    {
        $attributeDataSet = AttributeDataSet::of([
            AttributeData::of('volume', FrontendInput::TEXT, 'Volume'),
            AttributeData::of('density', FrontendInput::TEXT, 'Density'),
        ]);

        $expectedCommands = [
            'volume' => DeleteAttributeCommand::of('volume')
                ->withTimestamp(1509613892),
            'density' => DeleteAttributeCommand::of('density')
                ->withTimestamp(1509613892),
        ];


        self::assertEquals(
            $this->getJson($expectedCommands),
            $this->getJson($attributeDataSet->mapToDeleteCommands(1509613892))
        );
    }
}
