<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
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
            ],
            'custom_attributes' => []
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
        self::assertTrue(($product->getCustomAttributes())->isEmpty());
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

    public function testWithers()
    {
        $product = ProductData::of('snowio-test-product')
            ->withStatus(ProductStatus::DISABLED)
            ->withVisibility(ProductVisibility::CATALOG)
            ->withPrice('45.43')
            ->withTypeId(ProductTypeId::CONFIGURABLE)
            ->withAttributeSetCode('TestAttributeSet')
            ->withCustomAttribute(CustomAttribute::of('length', '100'))
            ->withCustomAttribute(CustomAttribute::of('width', '300'))
            ->withCustomAttribute(CustomAttribute::of('height', '250'))
            ->withCustomAttribute(CustomAttribute::of('density', '800'));

        self::assertEquals([
            'sku' => 'snowio-test-product',
            'status' => ProductStatus::DISABLED,
            'visibility' => ProductVisibility::CATALOG,
            'price' => '45.43',
            'type_id' => ProductTypeId::CONFIGURABLE,
            'extension_attributes' => [
                'attribute_set_code' => 'TestAttributeSet'
            ],
            'custom_attributes' => [
                [
                    'attribute_code' => 'length',
                    'value' => '100',
                ],
                [
                    'attribute_code' => 'width',
                    'value' => '300',
                ],
                [
                    'attribute_code' => 'height',
                    'value' => '250',
                ],
                [
                    'attribute_code' => 'density',
                    'value' => '800',
                ],
            ]
        ], $product->toJson());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid Type Id
     */
    public function testWithInvalidTypeId()
    {
        ProductData::of('snow-io-test-product')
            ->withTypeId('false_product');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid Status
     */
    public function testWithInvalidStatus()
    {
        ProductData::of('snow-io-test-product')
            ->withStatus(3);
    }

}
