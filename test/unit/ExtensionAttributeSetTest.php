<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

class ExtensionAttributeSetTest extends TestCase
{

    public function testToJson()
    {
        $extensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'default'),
            ExtensionAttribute::of('attribute_group_code', 'measurements'),
        ]);

        self::assertEquals([
            'attribute_set_code' => 'default',
            'attribute_group_code' => 'measurements'
        ], $extensionAttributeSet->toJson());
    }

    public function testWitherToSet()
    {
        $extensionAttributeSet = ExtensionAttributeSet::create();

        self::assertTrue($extensionAttributeSet->isEmpty());

        $extensionAttributeSet = $extensionAttributeSet
            ->withExtensionAttribute(ExtensionAttribute::of('attribute_set_code', 'default'))
            ->withExtensionAttribute(ExtensionAttribute::of('attribute_group_code', 'measurements'));

        self::assertEquals(2, $extensionAttributeSet->count());

        $extensionAttributeSet = $extensionAttributeSet
            ->withExtensionAttribute(ExtensionAttribute::of('attribute_set_code', 'general'))
            ->withExtensionAttribute(ExtensionAttribute::of('attribute_group_code', 'units'));

        $expectedExtensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
            ExtensionAttribute::of('attribute_group_code', 'units')
        ]);

        self::assertTrue($expectedExtensionAttributeSet->equals($extensionAttributeSet));

    }

    public function testEquality()
    {
        $expectedExtensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
        ]);

        $sameExtensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
        ]);

        $differentExtensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_group_code', 'measurements'),
        ]);

        self::assertTrue($expectedExtensionAttributeSet->equals($sameExtensionAttributeSet));
        self::assertFalse($expectedExtensionAttributeSet->equals($differentExtensionAttributeSet));
    }

    public function testDeleteExtensionAttributeByKey()
    {
        $extensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_test_1', 'general'),
            ExtensionAttribute::of('attribute_test_2', 'general'),
        ]);
        $extensionAttributeSet->delete('attribute_test_1');

        self::assertSame(1, $extensionAttributeSet->count());
    }

    public function testGet()
    {
        $extensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
        ]);

        self::assertTrue($extensionAttributeSet->get('attribute_set_code')
            ->equals(ExtensionAttribute::of('attribute_set_code', 'general')));
        self::assertNull($extensionAttributeSet->get('attribute_group_code'));
    }

    public function testFromJson()
    {
        $extensionAttributeSet = ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
            ExtensionAttribute::of('user_configuration_type', 'setting'),
            ExtensionAttribute::of('finance_vector', [
                'discount_weighting' => 0.23,
                'user_eligibility' => 89.4
            ]),
        ]);

        self::assertTrue(
            ExtensionAttributeSet::fromJson([
                    'attribute_set_code' => 'general',
                    'user_configuration_type' => 'setting',
                    'finance_vector' => [
                        'discount_weighting' => 0.23,
                        'user_eligibility' => 89.4
                    ]
                ]
            )->equals($extensionAttributeSet));
    }
}
