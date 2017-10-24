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
            'type_id' => 'simple',
            'extension_attributes' => [
                'attribute_set_code' => 'default'
            ]
        ],$product->toJson());
    }
}