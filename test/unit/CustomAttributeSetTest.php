<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;

class CustomAttributeSetTest extends TestCase
{
    public function testToJson()
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
        ], $customAttributeSet->toJson());
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

        $expectedAttributeSet = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '800'),
            CustomAttribute::of('density', '30'),
            CustomAttribute::of('volume', '90'),
        ]);

        self::assertTrue($expectedAttributeSet->equals($customAttributeSet));
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
        $expectedAttributeSet = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        self::assertTrue($expectedAttributeSet->equals($customAttributes));
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
}
