<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\StockItem;

class StockItemTest extends TestCase
{
    public function testToJson()
    {
        $stockItem = StockItem::of(1, 100);

        self::assertEquals([
            'stock_id' => 1,
            'qty' => 100,
        ], $stockItem->toJson());

        $stockItem = $stockItem
            ->withInStock(true)
            ->withUseConfigBackorders(true)
            ->withManageStock(false);

        self::assertEquals([
            'stock_id' => 1,
            'qty' => 100,
            'use_config_backorders' => true,
            'is_in_stock' => true,
            'manage_stock' => false,
        ], $stockItem->toJson());
    }

    public function testWithers()
    {
        $stockItem = StockItem::of(1, 100);
        self::assertEquals(1, $stockItem->getStockId());
        self::assertEquals(100, $stockItem->getQuantity());

        $stockItem = $stockItem->withInStock(false);
        self::assertEquals(false, $stockItem->isInStock());

        $stockItem = $stockItem->withQuantity(1000);
        self::assertEquals(1000, $stockItem->getQuantity());

        $stockItem = $stockItem->withUseConfigBackorders(true);
        self::assertEquals(true, $stockItem->getUseConfigBackorders());
    }

    public function testEquals()
    {
        $stockItem = StockItem::of(1, 100);
        self::assertTrue($stockItem->equals(StockItem::of(1, 100)));
        self::assertFalse($stockItem->equals(StockItem::of(1, 1000)));
        self::assertFalse($stockItem->equals(StockItem::of(10, 100)));
        self::assertFalse($stockItem->equals(StockItem::of(1, 100)->withUseConfigBackorders(true)));
        self::assertFalse($stockItem->equals(ExtensionAttribute::of('stock_size', 1000)));
        self::assertFalse($stockItem->equals(ExtensionAttribute::of('stock_item', 100)));
    }
}
