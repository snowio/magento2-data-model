<?php
declare(strict_types=1);
namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\AttributeOptionStoreLabel;
use SnowIO\Magento2DataModel\AttributeOptionStoreLabelSet;

class AttributeOptionTest extends TestCase
{
    public function testToJson()
    {
        $attributeOption = AttributeOption::of('size', 'large', 'Large')
            ->withSortOrder(3)
            ->withStoreLabels(AttributeOptionStoreLabelSet::of([
                AttributeOptionStoreLabel::of('en_gb', 'Large'),
                AttributeOptionStoreLabel::of('en_eu', 'Large'),
                AttributeOptionStoreLabel::of('de_de', 'Gross'),
                AttributeOptionStoreLabel::of('fr_fr', 'Grand'),
            ]));
        self::assertEquals([
            'entity_type' => 4,
            'attribute_code' => 'size',
            'option' => [
                'value' => 'large',
                'label' => 'Large',
                'sort_order' => 3,
                'store_labels' => [
                    [
                        'store_code' => 'en_gb',
                        'label' => 'Large'
                    ],
                    [
                        'store_code' => 'en_eu',
                        'label' => 'Large'
                    ],
                    [
                        'store_code' => 'de_de',
                        'label' => 'Gross'
                    ],
                    [
                        'store_code' => 'fr_fr',
                        'label' => 'Grand'
                    ],
                ]
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
