<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteProductCommand;

class DeleteProductCommandTest extends TestCase
{

    public function testToJson()
    {
        $command = DeleteProductCommand::of('test-product')->withTimestamp(123);
        self::assertEquals([
            '@timestamp' => (float)123,
            '@shardingKey' => 'test-product',
            '@commandGroupId' => 'product.test-product',
            'sku' => 'test-product',
        ], $command->toJson());
    }

    public function testStoreCode()
    {
        $command = DeleteProductCommand::of('test-product')->withStoreCode('admin')->withTimestamp(123);
        self::assertEquals([
            '@timestamp' => (float)123,
            '@store' => 'admin',
            '@shardingKey' => 'test-product',
            '@commandGroupId' => 'product.test-product',
            'sku' => 'test-product',
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $command = DeleteProductCommand::of('test-product');
        self::assertEquals('test-product', $command->getSku());
    }

}
