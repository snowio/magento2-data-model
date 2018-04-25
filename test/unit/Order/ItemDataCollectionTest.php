<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Order\ItemData;
use SnowIO\Magento2DataModel\Order\ItemDataCollection;

class ItemDataCollectionTest extends TestCase
{

    public function testWither()
    {
        $itemDataCollection = ItemDataCollection::of([
            ItemData::of('1'),
            ItemData::of('2'),
            ItemData::of('3'),
        ]);

        $itemDataCollection = $itemDataCollection->with(
            ItemData::of('4')
        );

        self::assertTrue(ItemDataCollection::of([
            ItemData::of('1'),
            ItemData::of('2'),
            ItemData::of('3'),
            ItemData::of('4'),
        ])->equals($itemDataCollection));

        //@todo what should we do if items of the same sku are added to the item set?
    }
}
