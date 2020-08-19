<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\SaveProductCommand;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\ProductStatus;
use SnowIO\Magento2DataModel\ProductVisibility;

class SaveProductCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = SaveProductCommand::of(ProductData::of('test-product', 'Test Product'));
        self::assertEquals([
            '@store' => 'admin',
            '@shardingKey' => 'test-product',
            '@commandGroupId' => 'product.admin.test-product',
            'sku' => 'test-product',
            'product' => [
                'sku' => 'test-product',
                'name' => 'Test Product',
                'status' => ProductStatus::ENABLED,
                'visibility' => ProductVisibility::CATALOG_SEARCH,
                'price' => null,
                'weight' => null,
                'type_id' => 'simple',
                'extension_attributes' => [
                    'attribute_set_code' => 'default'
                ],
                'custom_attributes' => [],
                'tier_prices' => [],
                'product_links' => [],
            ]
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $expected = ProductData::of('test-product', 'Test Product');
        $command = SaveProductCommand::of(ProductData::of('test-product', 'Test Product'));
        self::assertTrue($expected->equals($command->getProductData()));
    }
}
