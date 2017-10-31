<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\FrontendInput;

class AttributeTest extends TestCase
{
    public function testToJson()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter');
        self::assertEquals([
            'attribute_code' => 'diameter',
            'is_required' => false,
            'frontend_input' => 'text',
            'default_frontend_label' => 'Diameter',
        ], $attribute->toJson());
    }

    public function testWithers()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::BOOLEAN, 'Diameter')
            ->withRequired(true)
            ->withFrontendInput(FrontendInput::TEXT)
            ->withDefaultFrontendLabel('Diameter Updated!!!');

        self::assertEquals('diameter', $attribute->getCode());
        self::assertEquals(true, $attribute->isRequired());
        self::assertEquals(FrontendInput::TEXT, $attribute->getFrontendInput());
        self::assertEquals('Diameter Updated!!!', $attribute->getDefaultFrontendLabel());
    }

    public function testEquals()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter');
        self::assertTrue($attribute->equals(AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')));
        self::assertFalse($attribute->equals(AttributeData::of('viscosity', FrontendInput::TEXT, 'Viscosity')));
        self::assertFalse($attribute->equals(CustomAttribute::of('diameter', '300')));
    }
}
