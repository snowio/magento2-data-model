<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeValue;

class ExtensionAttributeTest extends TestCase
{

    public function testToJson()
    {
        $extensionAttribute = $this->createStockExtensionAttribute(10, 1000);
        self::assertEquals([
            'stock' => [
                'internal_amount' => 10,
                'warehouse_amount' => 1000
            ]
        ], $extensionAttribute->toJson());
    }

    public function testAccessors()
    {
        $extensionAttribute = $this->createStockExtensionAttribute(10, 1000);
        self::assertEquals('stock', $extensionAttribute->getCode());
    }

    public function testEquals()
    {
        $extensionAttribute = $this->createStockExtensionAttribute(10, 1000);
        $sameExtensionAttribute =  $this->createStockExtensionAttribute(10, 1000);
        $differentExtensionAttribute = $this->createStockExtensionAttribute(10, 100);
        self::assertTrue($extensionAttribute->equals($sameExtensionAttribute));
        self::assertFalse($extensionAttribute->equals($differentExtensionAttribute));
        self::assertFalse($extensionAttribute->equals(CustomAttribute::of('stock', '1000')));
    }

    private function createStockExtensionAttribute(int $internalAmount, int $warehouseAmount)
    {
        return StockItem::of($internalAmount, $warehouseAmount);
    }
}
