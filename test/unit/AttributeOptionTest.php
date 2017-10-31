<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\AttributeOption;

class AttributeOptionTest extends TestCase
{
    public function testToJson()
    {
        $attributeOption = AttributeOption::of('size', 'large', 'Large');
        self::assertEquals([
            'entity_type' => 4,
            'attribute_code' => 'size',
            'option' => [
                'value' => 'large',
                'label' => 'Large',
            ]
        ], $attributeOption->toJson());
    }

    public function testWithers()
    {
        $attributeOption = AttributeOption::of('size', 'large', 'Large')
            ->withLabel('Larger');
        self::assertEquals('size', $attributeOption->getAttributeCode());
        self::assertEquals('large', $attributeOption->getValue());
        self::assertEquals('Larger', $attributeOption->getLabel());
    }

    public function testEquals()
    {
        $attributeOption = AttributeOption::of('size', 'large', 'Large')
            ->withLabel('Larger');
        self::assertTrue($attributeOption->equals(AttributeOption::of('size', 'large', 'Large')
            ->withLabel('Larger')));
        self::assertFalse($attributeOption->equals(AttributeOption::of('size', 'small', 'Small')));
        self::assertFalse($attributeOption->equals(AttributeOption::of('size', 'large', 'Large')
            ->withLabel('Largest')));
        self::assertFalse($attributeOption->equals(AttributeData::of('size', 'text', 'Size')));
    }
}
