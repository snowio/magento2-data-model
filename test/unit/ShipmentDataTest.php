<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Shipment\Arguments;
use SnowIO\Magento2DataModel\Shipment\Comment;
use SnowIO\Magento2DataModel\Shipment\ItemSet;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;
use SnowIO\Magento2DataModel\Shipment\TrackSet;
use SnowIO\Magento2DataModel\ShipmentData;

class ShipmentDataTest extends TestCase
{
    public function testJson()
    {
        $shipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        self::assertEquals($this->getShipmentsJson(), $shipmentData->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getShipmentsJson();
        $shipmentData = ShipmentData::fromJson($json);
        self::assertTrue($shipmentData->getItems()->equals(ItemSet::fromJson($json['items'])));
        self::assertEquals($json['notify'], $shipmentData->getNotify());
        self::assertEquals($json['appendComment'], $shipmentData->getAppendComment());
        self::assertTrue($shipmentData->getComment()->equals(Comment::fromJson($json['comment'])));
        self::assertTrue($shipmentData->getTracks()->equals(TrackSet::fromJson($json['tracks'])));
        self::assertTrue($shipmentData->getPackages()->equals(PackageCollection::fromJson($json['packages'])));
        self::assertTrue($shipmentData->getArguments()->equals(Arguments::fromJson($json['arguments'])));
    }

    public function testEquals()
    {
        $shipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        $otherShipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        self::assertTrue($shipmentData->equals($otherShipmentData));
        $otherShipmentData = $otherShipmentData->withAppendComment(false);
        self::assertFalse($shipmentData->equals($otherShipmentData));
    }

    public function testWitherToSet()
    {
        $json = $this->getShipmentsJson();
        $shipmentData = ShipmentData::create()
            ->withItems(ItemSet::fromJson($json['items']))
            ->withNotify($json['notify'])
            ->withAppendComment($json['appendComment'])
            ->withComment(Comment::fromJson($json['comment']))
            ->withTracks(TrackSet::fromJson($json['tracks']))
            ->withPackages(PackageCollection::fromJson($json['packages']))
            ->withArguments(Arguments::fromJson($json['arguments']));
        self::assertTrue($shipmentData->equals(ShipmentData::fromJson($json)));
    }

    private function getShipmentsJson()
    {
        return [
            "items" => [
                [
                    "extension_attributes" => [],
                    "order_item_id" => 0,
                    "qty" => 0
                ]
            ],
            "notify" => true,
            "appendComment" => true,
            "comment" => [
                "extension_attributes" => [],
                "comment" => "string",
                "is_visible_on_front" => 0
            ],
            "tracks" => [
                [
                    "extension_attributes" => [],
                    "track_number" => "string",
                    "title" => "string",
                    "carrier_code" => "string"
                ]
            ],
            "packages" => [
                [
                    "extension_attributes" => []
                ]
            ],
            "arguments" => [
                "extension_attributes" => []
            ]
        ];
    }
}