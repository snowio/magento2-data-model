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
        $stockItem = StockItem::create(1, 100);
        self::assertEquals([
            'stock_item' => [
                'stock_id' => 1,
                'qty' => 100,
                'is_in_stock' => true,
            ]
        ], $stockItem->toJson());
    }

    public function testWithers()
    {
        $stockItem = StockItem::create(1, 100);
        self::assertEquals(1, $stockItem->getStockId());
        self::assertEquals(100, $stockItem->getQuantity());

        $stockItem = $stockItem->withInStock(false);
        self::assertEquals(false, $stockItem->isInStock());

        $stockItem = $stockItem->withQuantity(1000);
        self::assertEquals(1000, $stockItem->getQuantity());
    }

    public function testEquals()
    {
        $stockItem = StockItem::create(1, 100);
        self::assertTrue($stockItem->equals(StockItem::create(1, 100)));
        self::assertFalse($stockItem->equals(StockItem::create(1, 1000)));
        self::assertFalse($stockItem->equals(StockItem::create(10, 100)));
        self::assertFalse($stockItem->equals(ExtensionAttribute::of('stock_size', 1000)));
        self::assertFalse($stockItem->equals(ExtensionAttribute::of('stock_item', 100)));
    }
}
