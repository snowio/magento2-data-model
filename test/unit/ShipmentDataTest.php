<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Argument;
use SnowIO\Magento2DataModel\Shipment\Comment;
use SnowIO\Magento2DataModel\Shipment\CommentCollection;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemCollection;
use SnowIO\Magento2DataModel\Shipment\Package;
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
            "order_increment_id" => "100",
            "arguments" => Argument::create()->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of('code1', 'value1'),
                    ExtensionAttribute::of('code2', 'value2')
                ])
            )->toJson(),
            "notify" => true,
            "append_comment" => true,
            "comments" => CommentCollection::create()->with(Comment::create()
                ->withComment("test comment")
                ->withIsCustomerNotified(1)
                ->withIsVisibleOnFront(1)
                ->withParentId(200)
            )->toJson(),
            "items" => ItemCollection::create()->with(Item::create()
                ->withOrderItemId(1)
                ->withQty(1)
            )->toJson(),
            "packages" => PackageCollection::create()->with(
                Package::create()
                    ->withExtensionAttributes(
                        ExtensionAttributeSet::create()
                            ->withExtensionAttribute(ExtensionAttribute::of('code','value')
                        )
                    )
                )->toJson(),
            "tracks" => TrackSet::of([Track::create()
                ->withCarrierCode('test_carrier')
                ->withTitle('test title')
                ->withTrackNumber("1211TRACKTEST")
            ])->toJson(),
        ];
    }
}