<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Track;

class TrackTest extends TestCase
{
    public function testJson()
    {
        $track = Track::fromJson($this->getTrackJson());
        self::assertEquals($this->getTrackJson(), $track->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getTrackJson();
        $trackData = Track::fromJson($json);
        self::assertEquals($json['track_number'], $trackData->getTrackNumber());
        self::assertEquals($json['carrier_code'], $trackData->getCarrierCode());
        self::assertEquals($json['title'], $trackData->getTitle());
        self::assertTrue(
            $trackData->getExtensionAttributes()->equals(
                ExtensionAttributeSet::fromJson($json['extension_attributes'])
            )
        );
    }

    public function testEquals()
    {
        $track = Track::fromJson($this->getTrackJson());
        $otherTrack = Track::fromJson($this->getTrackJson());
        self::assertTrue($track->equals($otherTrack));
        $otherTrack = $otherTrack->withExtensionAttributes(
            ExtensionAttributeSet::of([ExtensionAttribute::of('foo', 'bar')])
        );
        self::assertFalse($track->equals($otherTrack));
    }

    public function testWitherToSet()
    {
        $json = $this->getTrackJson();
        $json["extension_attributes"] = ['foo' => 'bar'];
        $trackData = Track::create()
            ->withTrackNumber("string")
            ->withTitle("string")
            ->withCarrierCode("string")
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('foo', 'bar')
            ]));
        self::assertTrue($trackData->equals(Track::fromJson($json)));
    }

    private function getTrackJson()
    {
        return [
            "extension_attributes" => [],
            "track_number" => "string",
            "title" => "string",
            "carrier_code" => "string"
        ];
    }
}