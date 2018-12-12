<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
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

    /**
     * @expectedException \SnowIO\Magento2DataModel\MagentoDataException
     */
    public function testFunctionalToNonExpectedFunction()
    {
        $shipmentData = ShipmentData::fromJson($this->getShipmentsJson());
        $shipmentData->getFooBar();
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

    public function testWitherToSet()
    {
        $json = $this->getShipmentsJson();
        $shipmentData = ShipmentData::create()
            ->withTracks(TrackSet::fromJson($json['tracks']));
        self::assertTrue($shipmentData->equals(ShipmentData::fromJson($json)));
    }

    private function getShipmentsJson()
    {
        return [
            "tracks" => [
                [
                    "extension_attributes" => [],
                    "track_number" => "string",
                    "title" => "string",
                    "carrier_code" => "string"
                ]
            ],
        ];
    }
}