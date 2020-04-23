<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\AttributeScope;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\FrontendInput;
use SnowIO\Magento2DataModel\SwatchInputType;

class AttributeDataTest extends TestCase
{
    public function testToJson()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')->withSwatchInputType(null);
        self::assertEquals([
            'attribute_code' => 'diameter',
            'is_required' => false,
            'frontend_input' => 'text',
            'default_frontend_label' => 'Diameter',
            'scope' => AttributeScope::GLOBAL,
        ], $attribute->toJson());
    }

    public function testToJsonWithSwatchInputType()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')
            ->withSwatchInputType(SwatchInputType::DROPDOWN);
        self::assertEquals([
            'attribute_code' => 'diameter',
            'is_required' => false,
            'frontend_input' => 'text',
            'default_frontend_label' => 'Diameter',
            'scope' => AttributeScope::GLOBAL,
            'swatch_input_type' => SwatchInputType::DROPDOWN,
        ], $attribute->toJson());
    }

    public function testWithers()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::BOOLEAN, 'Diameter')
            ->withRequired(true)
            ->withFrontendInput(FrontendInput::TEXT)
            ->withScope(AttributeScope::GLOBAL)
            ->withDefaultFrontendLabel('Diameter Updated!!!')
            ->withSwatchInputType(SwatchInputType::TEXT);

        self::assertEquals('diameter', $attribute->getCode());
        self::assertEquals(true, $attribute->isRequired());
        self::assertEquals(FrontendInput::TEXT, $attribute->getFrontendInput());
        self::assertEquals('global', $attribute->getScope());
        self::assertEquals('Diameter Updated!!!', $attribute->getDefaultFrontendLabel());
        self::assertEquals(SwatchInputType::TEXT, $attribute->getSwatchInputType());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidScope()
    {
        AttributeData::of('diameter', FrontendInput::BOOLEAN, 'Diameter')
            ->withScope('site');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidSwatchInputType()
    {
        AttributeData::of('diameter', FrontendInput::BOOLEAN, 'Diameter')
            ->withSwatchInputType('bla');
    }

    public function testEquals()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter');
        self::assertTrue($attribute->equals(AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')));
        self::assertFalse($attribute->equals(AttributeData::of('viscosity', FrontendInput::TEXT, 'Viscosity')));
        self::assertFalse($attribute->equals(CustomAttribute::of('diameter', '300')));
    }

    public function testEqualsWithSwatchInputType()
    {
        $attribute = AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')
            ->withSwatchInputType(SwatchInputType::TEXT);
        self::assertTrue($attribute->equals(AttributeData::of('diameter', FrontendInput::TEXT, 'Diameter')
            ->withSwatchInputType(SwatchInputType::TEXT)));
        self::assertFalse($attribute->equals(AttributeData::of('viscosity', FrontendInput::TEXT, 'Viscosity')));
    }
}
