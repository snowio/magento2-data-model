<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\ProductOptionData;

class ProductOptionDataTest extends TestCase
{
    public function testToJson()
    {
        $productOption = self::getProductOption();
        self::assertEquals(self::getProductOptionJson(), $productOption->toJson());
    }

    public function testFromJson()
    {
        $productOption = ProductOptionData::fromJson(self::getProductOptionJson());
        self::assertTrue(ExtensionAttributeSet::of([
            ExtensionAttribute::of('attribute_set_code', 'general'),
        ])->equals($productOption->getExtensionAttributes()));
    }


    public function testEquals()
    {
        $item = self::getProductOption();
        $otherItem = self::getProductOption();
        self::assertTrue($item->equals($otherItem));
        self::assertFalse(($item->withExtensionAttributes(
            ExtensionAttributeSet::of([
                ExtensionAttribute::of('user_group_code','plumbers')
            ])
        ))->equals($otherItem));
        self::assertFalse(
            $otherItem->equals(ExtensionAttribute::of('user_group_code', 'plumbers'))
        );
    }

    public static function getProductOptionJson(): array
    {
        return [
            'extension_attributes' => [
                "attribute_set_code" => "general"
            ]
        ];
    }

    public static function getProductOption() : ProductOptionData
    {
        return ProductOptionData::create()
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('attribute_set_code', 'general'),
            ]));
    }
}