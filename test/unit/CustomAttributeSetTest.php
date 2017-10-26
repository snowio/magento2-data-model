<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\MagentoDataException;

class CustomAttributeSetTest extends TestCase
{
    public function testInitialisation()
    {
        $customAttributeSet = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        self::assertEquals([
            [
                'attribute_code' => 'diameter',
                'value' => '900'
            ],
            [
                'attribute_code' => 'volume',
                'value' => '90'
            ],
            [
                'attribute_code' => 'density',
                'value' => '40'
            ],
        ], array_map([$this, 'getJson'], iterator_to_array($customAttributeSet)));

    }

    /**
     * @expectedException SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Each custom attribute code must be unique
     */
    public function testInvalidSetAttributesWithSameKey()
    {
        CustomAttributeSet::of([
            CustomAttribute::of('volume', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);
    }

    public function testWitherToSet()
    {
        $customAttributeSet = CustomAttributeSet::create();

        self::assertTrue($customAttributeSet->isEmpty());

        $customAttributeSet = $customAttributeSet
            ->withCustomAttribute(CustomAttribute::of('volume', '900'));

        self::assertEquals(1, $customAttributeSet->count());

        $customAttributeSet = $customAttributeSet
            ->withCustomAttribute(CustomAttribute::of('diameter', '800'))
            ->withCustomAttribute(CustomAttribute::of('density', '30'))
            ->withCustomAttribute(CustomAttribute::of('volume', '90'));

        self::assertEquals([
            [
                'attribute_code' => 'volume',
                'value' => '90'
            ],
            [
                'attribute_code' => 'diameter',
                'value' => '800'
            ],
            [
                'attribute_code' => 'density',
                'value' => '30'
            ],
        ], array_map([$this, 'getJson'], iterator_to_array($customAttributeSet)));

    }

    public function testAddToSet()
    {
        $customAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
        ]);

        $otherAttributes = CustomAttributeSet::of([
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        $customAttributes = $customAttributes->add($otherAttributes);

        self::assertEquals([
            [
                'attribute_code' => 'diameter',
                'value' => '900'
            ],
            [
                'attribute_code' => 'volume',
                'value' => '90'
            ],
            [
                'attribute_code' => 'density',
                'value' => '40'
            ],
        ], array_map([$this, 'getJson'], iterator_to_array($customAttributes)));
    }

    /**
     * These attributes overlap thus this should throw an exception
     * @expectedException SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Each custom attribute code must be unique
     */
    public function testInvalidAddToSet()
    {
        $customAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        $otherAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        $customAttributes->add($otherAttributes);
    }

    public function testEquality()
    {
        $customAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        $sameAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        self::assertTrue($customAttributes->equals($sameAttributes));
    }

    private function getJson(CustomAttribute $customAttribute)
    {
        return $customAttribute->toJson();
    }
}