<?php
declare(strict_types=1);
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
        $product = ProductData::of('snowio-test-product', 'Snowio Test Product');
        self::assertEquals([
            'sku' => 'snowio-test-product',
            'name' => 'Snowio Test Product',
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
        $product = ProductData::of('snowio-test-product', 'Snowio Test Product');
        self::assertEquals('snowio-test-product', $product->getSku());
        self::assertEquals('Snowio Test Product', $product->getName());
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
        ProductData::of('snowio-test-product', 'test')
            ->withVisibility(5);
    }

    public function testWithers()
    {
        $product = ProductData::of('snowio-test-product', 'Snowio Test Product')
            ->withName('Snowio Test Product Updated!!')
            ->withStatus(ProductStatus::DISABLED)
            ->withVisibility(ProductVisibility::CATALOG)
            ->withPrice('45.43')
            ->withTypeId(ProductTypeId::CONFIGURABLE)
            ->withAttributeSetCode('TestAttributeSet')
            ->withCustomAttribute(CustomAttribute::of('length', '100'))
            ->withCustomAttribute(CustomAttribute::of('width', '300'))
            ->withCustomAttribute(CustomAttribute::of('height', '250'))
            ->withCustomAttribute(CustomAttribute::of('density', '800'));

        self::assertSame('Snowio Test Product Updated!!', $product->getName());
        self::assertSame(ProductStatus::DISABLED, $product->getStatus());
        self::assertSame(ProductVisibility::CATALOG, $product->getVisibility());
        self::assertSame('45.43', $product->getPrice());
        self::assertSame(ProductTypeId::CONFIGURABLE, $product->getTypeId());
        self::assertSame('TestAttributeSet', $product->getAttributeSetCode());
        $expectedCustomAttributes = CustomAttributeSet::create()
            ->withCustomAttribute(CustomAttribute::of('length', '100'))
            ->withCustomAttribute(CustomAttribute::of('width', '300'))
            ->withCustomAttribute(CustomAttribute::of('height', '250'))
            ->withCustomAttribute(CustomAttribute::of('density', '800'));
        self::assertTrue($product->getCustomAttributes()->equals($expectedCustomAttributes));
    }

    public function testWithCustomAttributeSet()
    {
        $product = ProductData::of('snowio-test-product', 'Snowio Test Product Updated!!')
            ->withCustomAttributes(CustomAttributeSet::of([
                CustomAttribute::of('diameter', '900'),
                CustomAttribute::of('volume', '90'),
                CustomAttribute::of('density', '40'),
            ]));

        $expectedCustomAttributes = CustomAttributeSet::of([
            CustomAttribute::of('diameter', '900'),
            CustomAttribute::of('volume', '90'),
            CustomAttribute::of('density', '40'),
        ]);

        self::assertTrue($product->getCustomAttributes()->equals($expectedCustomAttributes));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid Type Id
     */
    public function testWithInvalidTypeId()
    {
        ProductData::of('snow-io-test-product', 'Snowio Test Product Updated')
            ->withTypeId('false_product');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid Status
     */
    public function testWithInvalidStatus()
    {
        ProductData::of('snow-io-test-product', 'Snowio Test Product Updated')
            ->withStatus(3);
    }

    public function testEquals()
    {
        self::assertTrue((ProductData::of('test-product', 'test'))->equals(ProductData::of('test-product', 'test')));
        self::assertFalse((ProductData::of('test-product', 'test')->withPrice('100.78'))->equals(ProductData::of('test-product', 'test')
            ->withPrice('89.43')));
        self::assertFalse((ProductData::of('test-product', 'test')->withCustomAttribute(CustomAttribute::of('weight',
            '30')))->equals(ProductData::of('test-product', 'test')
            ->withCustomAttribute(CustomAttribute::of('weight', '59'))));

        self::assertFalse((ProductData::of('test-product', 'test'))->equals(CustomAttribute::of('foo', 'bar')));
    }

}
