<?php

namespace SnowIO\Magento2DataModel\Test;


use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\ShipOrderCommand;
use SnowIO\Magento2DataModel\Shipment\Comment;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemSet;
use SnowIO\Magento2DataModel\Shipment\Track;
use SnowIO\Magento2DataModel\Shipment\TrackSet;
use SnowIO\Magento2DataModel\ShipmentData;

class ShipOrderCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = ShipOrderCommand::of(
            323323,
            ShipmentData::create()
                ->withTracks(
                    TrackSet::of([
                        Track::create()
                            ->withTitle('Test tracking title')
                            ->withCarrierCode('Test Carrier code')
                            ->withTrackNumber('2398749234ND'),
                        Track::create()
                            ->withTitle('Test tracking title 2')
                            ->withCarrierCode('Test Carrier code 2')
                            ->withTrackNumber('6482376348BE')
                    ])
                )
                ->withItems(
                    ItemSet::of([
                        Item::of(323, 453543),
                        Item::of(324, 438942)
                    ])
                )
                ->withNotify(true)
                ->withAppendComment(true)
                ->withComment(
                    Comment::create()
                        ->withComment('Foo Bar')
                        ->withIsVisibleOnFront(1)
                )
        );

        self::assertEquals([
            'orderId' => 323323,
            'items' => [
                [
                    'extension_attributes' => [],
                    "order_item_id" => 323,
                    "qty" => 453543
                ],
                [
                    'extension_attributes' => [],
                    "order_item_id" => 324,
                    "qty" => 438942
                ]
            ],
            'tracks' => [
                [
                    'extension_attributes' => [],
                    'track_number' => '2398749234ND',
                    'title' => 'Test tracking title',
                    'carrier_code'=> 'Test Carrier code',
                ],
                [
                    'extension_attributes' => [],
                    'track_number' => '6482376348BE',
                    'title' => 'Test tracking title 2',
                    'carrier_code'=> 'Test Carrier code 2',
                ]
            ],
            'notify' => true,
            'appendComment' => true,
            'comment' => [
                "extension_attributes" => [],
                "comment" => "Foo Bar",
                "is_visible_on_front" => 1
            ],
            "arguments" => [
                'extension_attributes' => []
            ],
            "packages" => [],
            '@commandGroupId' => 'ship_order.order.323323'
        ], $command->toJson());
    }
}