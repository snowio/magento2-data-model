<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductData;

class ProductDataTest extends TestCase
{
    public function testInitialization()
    {
        $product = ProductData::of('snowio-test-product');
        self::assertEquals([
            'sku' => 'snowio-test-product',
            'status' => 1,
            'visibility' => 4,
            'price' => 3.39,
            'type_id' => 'simple',
            'extension_attributes' => [
                'attribute_set_code' => 'default'
            ]
        ],$product->toJson());
    }

    public function testAccessors()
    {
        $product = ProductData::of('snowio-test-product');
        self::assertEquals('snowio-test-product', $product->getSku());
        self::assertEquals(1, $product->getStatus());
        self::assertEquals(4, $product->getVisibility());
        self::assertEquals(3.39, $product->getPrice());
        self::assertEquals(ProductData::SIMPLE_PRODUCT, $product->getTypeId());
        self::assertEquals(ProductData::DEFAULT_ATTRIBUTE_SET, $product->getAttributeSetCode());
    }
}