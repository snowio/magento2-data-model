<?php
declare(strict_types = 1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Item;

class ItemTest extends TestCase
{
    public function testJson()
    {
        $itemData = Item::fromJson($this->getItemJson());
        self::assertEquals($this->getItemJson(), $itemData->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getItemJson();
        $itemData = Item::fromJson($json);
        self::assertEquals($json['order_item_id'], $itemData->getOrderItemId());
        self::assertTrue(
            $itemData->getExtensionAttributes()
                ->equals(ExtensionAttributeSet::fromJson($json['extension_attributes']))
        );
        self::assertEquals($json['qty'], $itemData->getQty());
    }

    public function testEquals()
    {
        $itemData = Item::fromJson($this->getItemJson());
        $otherItemData = Item::fromJson($this->getItemJson());
        self::assertTrue($itemData->equals($otherItemData));
        $otherItemData = $otherItemData->withQty(1000);
        self::assertFalse($itemData->equals($otherItemData));
    }

    public function testWitherToSet()
    {
        $json = $this->getItemJson();
        $itemData = Item::create()
            ->withOrderItemId(0)
            ->withQty(0);
        self::assertTrue($itemData->equals(Item::fromJson($json)));
    }

    private function getItemJson()
    {
        return [
            "extension_attributes" => [],
            "order_item_id" => 0,
            "qty" => 0
        ];
    }
}