<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Attribute;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\FrontendInput;

class AttributeTest extends TestCase
{
    public function testToJson()
    {
        $attribute = Attribute::of('diameter', FrontendInput::TEXT, 'Diameter');
        self::assertEquals([
            'attribute_code' => 'diameter',
            'is_required' => false,
            'frontend_input' => 'text',
            'frontend_labels' => [
                [
                    'store_id' => 0,
                    'label' => 'Diameter',
                ]
            ],
            'default_frontend_label' => 'Diameter',
        ], $attribute->toJson());
    }

    public function testWithers()
    {
        $attribute = Attribute::of('diameter', FrontendInput::BOOLEAN, 'Diameter')
            ->withIsRequired(true)
            ->withFrontendInput(FrontendInput::TEXT);

        self::assertEquals('diameter', $attribute->getCode());
        self::assertEquals(true, $attribute->isRequired());
        self::assertEquals(FrontendInput::TEXT, $attribute->getFrontendInput());
        self::assertEquals([
            [
                'store_id' => 0,
                'label' => 'Diameter',
            ]
        ], $attribute->getFrontendLabels());
        self::assertEquals('Diameter', $attribute->getDefaultFrontendLabel());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidFrontendInput()
    {
        Attribute::of('gender', 'radio_group', 'Gender');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidFrontendInputInWither()
    {
        Attribute::of('gender', FrontendInput::BOOLEAN, 'Gender')
            ->withFrontendInput('radio_group');
    }


    public function testEquals()
    {
        $attribute = Attribute::of('diameter', FrontendInput::TEXT, 'Diameter');
        self::assertTrue($attribute->equals(Attribute::of('diameter', FrontendInput::TEXT, 'Diameter')));
        self::assertFalse($attribute->equals(Attribute::of('viscosity', FrontendInput::TEXT, 'Viscosity')));
        self::assertFalse($attribute->equals(CustomAttribute::of('diameter', '300')));
    }
}