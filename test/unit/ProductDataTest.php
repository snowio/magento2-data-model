<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\ProductStatus;
use SnowIO\Magento2DataModel\ProductTypeId;
use SnowIO\Magento2DataModel\ProductVisibility;

class ProductDataTest extends TestCase
{
    public function testToJson()
    {
        $product = ProductData::of('snowio-test-product');
        self::assertEquals([
            'sku' => 'snowio-test-product',
            'status' => ProductStatus::ENABLED,
            'visibility' => ProductVisibility::CATALOG_SEARCH,
            'price' => null,
            'type_id' => 'simple',
            'extension_attributes' => [
                'attribute_set_code' => 'default'
            ]
        ], $product->toJson());
    }

    public function testDefaultValuesAreCorrect()
    {
        $product = ProductData::of('snowio-test-product');
        self::assertEquals('snowio-test-product', $product->getSku());
        self::assertEquals(ProductStatus::ENABLED, $product->getStatus());
        self::assertEquals(ProductVisibility::CATALOG_SEARCH, $product->getVisibility());
        self::assertEquals(null, $product->getPrice());
        self::assertEquals(ProductTypeId::SIMPLE, $product->getTypeId());
        self::assertEquals(ProductData::DEFAULT_ATTRIBUTE_SET_CODE, $product->getAttributeSetCode());
    }

    /**
     * Visibility should only be the following
     * not_visible_individually -> 1
     * catalog -> 2
     * search -> 3
     * catalog_search -> 4
     * Any other visibility value is invalid
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid Visibility
     */
    public function testWithInvalidVisibility()
    {
        ProductData::of('snowio-test-product')
            ->withVisibility(5);
    }
}
