<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\AttributeDataSet;
use SnowIO\Magento2DataModel\FrontendInput;

class AttributeDataSetTest extends TestCase
{
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
}
