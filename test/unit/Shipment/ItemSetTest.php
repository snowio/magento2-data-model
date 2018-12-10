<?php
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemSet;

class ItemSetTest extends TestCase
{
    public function testJson()
    {
        $itemSet = ItemSet::fromJson($this->getItemSetJson());
        self::assertEquals($this->getItemSetJson(), $itemSet->toJson());
    }

    public function testWithers()
    {
        $itemSet = ItemSet::of([
            Item::of(2, 23),
            Item::of(1, 2),
            Item::of(3, 4),
        ]);

        self::assertTrue(
            ItemSet::fromJson($this->getItemSetJson())->equals($itemSet)
        );
    }

    public function testEquals()
    {
        $itemSet = ItemSet::fromJson($this->getItemSetJson());
        $otherItemSet = ItemSet::fromJson($this->getItemSetJson());

        self::assertTrue($itemSet->equals($otherItemSet));
        $itemSet = $itemSet->with(Item::of(9,8));
        self:: assertFalse($itemSet->equals($otherItemSet));
    }


    private function getItemSetJson()
    {
        return [
            [
                "extension_attributes" => [],
                "order_item_id" => 2,
                "qty" => 23
            ],
            [
                "extension_attributes" => [],
                "order_item_id" => 1,
                "qty" => 2
            ],
            [
                "extension_attributes" => [],
                "order_item_id" => 3,
                "qty" => 4
            ]
        ];
    }
}