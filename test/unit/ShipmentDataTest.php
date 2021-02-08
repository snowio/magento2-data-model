<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Comment;
use SnowIO\Magento2DataModel\Shipment\CommentCollection;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemCollection;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;
use SnowIO\Magento2DataModel\Shipment\Track;
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
        self::assertTrue($shipmentData->getTracks()->equals(TrackSet::fromJson($json['tracks'])));
    }

    public function testEquals()
    {
        $shipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        $otherShipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        self::assertTrue($shipmentData->equals($otherShipmentData));
        $shipmentData = $shipmentData->withTracks(TrackSet::of([
            Track::create()
                ->withTitle('Foo')
                ->withTrackNumber('23y942387ry283y7r8y29')
        ]));
        self::assertFalse($shipmentData->equals($otherShipmentData));
    }

    private function getShipmentsJson()
    {
        return [
            "billing_address_id" => 1,
            "comments" => CommentCollection::create()->with(Comment::create()
                ->withComment("test comment")
                ->withIsCustomerNotified(1)
                ->withIsVisibleOnFront(1)
                ->withParentId(200)
            )->toJson(),
            "created_at" => "2021-02-08 12:00:00",
            "customer_id" => null,
            "email_sent" => null,
            "entity_id" => null,
            "extension_attributes" => ExtensionAttributeSet::create()->toJson(),
            "increment_id" => null,
            "items" => ItemCollection::create()->with(Item::create()
                ->withOrderItemId(1)
                ->withQty(1)
            )->toJson(),
            "order_id" => 100,
            "packages" => PackageCollection::create()->toJson(),
            "shipment_status" => null,
            "shipping_address_id" => null,
            "shipping_label" => null,
            "store_id" => null,
            "total_qty" => null,
            "total_weight" => null,
            "tracks" => TrackSet::of([Track::create()
                ->withCarrierCode('test_carrier')
                ->withDescription('test description')
                ->withOrderId(100)
                ->withParentId(200)
                ->withQty(1)
                ->withTitle('test title')
                ->withTrackNumber("1211TRACKTEST")
                ->withWeight(10)
            ])->toJson(),
        ];
    }
}