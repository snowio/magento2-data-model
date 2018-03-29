<?php
declare(strict_types = 1);

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\EavEntityTrait;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\ProductLink;
use SnowIO\Magento2DataModel\ProductLinkSet;
use SnowIO\Magento2DataModel\ProductStatus;
use SnowIO\Magento2DataModel\ProductTypeId;
use SnowIO\Magento2DataModel\ProductVisibility;
use SnowIO\Magento2DataModel\StockItem;
use SnowIO\Magento2DataModel\TierPrice;
use SnowIO\Magento2DataModel\TierPriceSet;

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
            'weight' => null,
            'type_id' => 'simple',
            'extension_attributes' => [
                'attribute_set_code' => 'default'
            ],
            'custom_attributes' => [],
            'media_gallery_entries' => [],
            'tier_prices' => [],
            'product_links' => [],
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
        self::assertEquals(null, $product->getWeight());
        self::assertEquals(ProductTypeId::SIMPLE, $product->getTypeId());
        self::assertEquals(ProductData::DEFAULT_ATTRIBUTE_SET_CODE, $product->getAttributeSetCode());
        self::assertTrue(($product->getCustomAttributes())->isEmpty());
        self::assertTrue(($product->getMediaGalleryEntries())->isEmpty());
        self::assertTrue(($product->getTierPrices())->isEmpty());
        self::assertTrue(($product->getProductLinks())->isEmpty());
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
        /** @var ProductData $product */
        $product = ProductData::of('snowio-test-product', 'Snowio Test Product')
            ->withName('Snowio Test Product Updated!!')
            ->withStatus(ProductStatus::DISABLED)
            ->withVisibility(ProductVisibility::CATALOG)
            ->withPrice('45.43')
            ->withWeight('10.1')
            ->withTypeId(ProductTypeId::CONFIGURABLE)
            ->withAttributeSetCode('TestAttributeSet')
            ->withStoreCode('default')
            ->withStockItem(StockItem::of(1, 300))
            ->withTierPrices(TierPriceSet::of([TierPrice::of(1,1,'100')]))
            ->withProductLinks(ProductLinkSet::create()->withProductLink(
                ProductLink::of('KEY', 'x', 'type')
            ))
            ->withCustomAttribute(CustomAttribute::of('length', '100'))
            ->withCustomAttribute(CustomAttribute::of('width', '300'))
            ->withCustomAttribute(CustomAttribute::of('height', '250'))
            ->withCustomAttribute(CustomAttribute::of('density', '800'))
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('warehouse_specifications', [
                    'part_number' => 4894379374,
                    'manufacturer_reference' => '49j03j94r',
                ]),
            ]));

        self::assertSame(
            TierPriceSet::of([TierPrice::of(1,1,'100')])->toJson(),
            $product->getTierPrices()->toJson()
        );
        self::assertSame(
            ProductLinkSet::of([ProductLink::of('KEY', 'x', 'type')])->toJson(),
            $product->getProductLinks()->toJson()
        );
        self::assertSame('Snowio Test Product Updated!!', $product->getName());
        self::assertSame(ProductStatus::DISABLED, $product->getStatus());
        self::assertSame(ProductVisibility::CATALOG, $product->getVisibility());
        self::assertSame('45.43', $product->getPrice());
        self::assertSame('10.1', $product->getWeight());
        self::assertEquals('default', $product->getStoreCode());
        self::assertTrue((StockItem::of(1, 300))->equals($product->getStockItem()));
        self::assertSame(ProductTypeId::CONFIGURABLE, $product->getTypeId());
        self::assertSame('TestAttributeSet', $product->getAttributeSetCode());
        //NOTE: The preservation of stock_item and attribute_set_code
        //please review this technical decision
        self::assertTrue(ExtensionAttributeSet::of([
            ExtensionAttribute::of('warehouse_specifications', [
                'part_number' => 4894379374,
                'manufacturer_reference' => '49j03j94r',
            ]),
            ExtensionAttribute::of('attribute_set_code', 'TestAttributeSet'),
            ExtensionAttribute::of('stock_item', [
                'stock_id' => 1,
                'qty' => 300,
            ]),
        ])->equals($product->getExtensionAttributes()));
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
        self::assertFalse(
            (ProductData::of('test-product', 'test')
                ->withPrice('100.78'))
                ->equals(
                    ProductData::of('test-product', 'test')->withPrice('89.43')
                )
        );
        self::assertFalse(
            (ProductData::of('test-product', 'test')
                ->withCustomAttribute(CustomAttribute::of('weight', '30')))
                ->equals(
                    ProductData::of('test-product', 'test')
                        ->withCustomAttribute(CustomAttribute::of('weight', '59'))
                )
        );
        self::assertFalse((ProductData::of('test-product', 'test'))->equals(CustomAttribute::of('foo', 'bar')));
    }
}
