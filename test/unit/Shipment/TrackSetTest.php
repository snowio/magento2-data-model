<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Shipment\Track;
use SnowIO\Magento2DataModel\Shipment\TrackSet;

class TrackSetTest extends TestCase
{
    public function testJson()
    {
        $trackSet = TrackSet::fromJson($this->getTrackSetJson());
        self::assertEquals($this->getTrackSetJson(), $trackSet->toJson());
    }

    public function testWithers()
    {
        $trackSet = TrackSet::create()
            ->with(
                Track::create()
                    ->withTrackNumber("t1")
                    ->withTitle("Track 1")
                    ->withCarrierCode("string")
            )
            ->with(
                Track::create()
                    ->withTrackNumber("t2")
                    ->withTitle("Track 2")
                    ->withCarrierCode("Track 2")
            );

        self::assertTrue(
            TrackSet::fromJson($this->getTrackSetJson())
                ->equals($trackSet)
        );
    }

    public function testEquals()
    {
        $trackSet = TrackSet::fromJson($this->getTrackSetJson());
        $otherTrackSet = TrackSet::fromJson($this->getTrackSetJson());
        self::assertTrue($trackSet->equals($otherTrackSet));
        $trackSet  = $trackSet->with(
            Track::create()
                ->withTrackNumber("t3")
                ->withTitle("Track 3")
                ->withCarrierCode("Track 3")
        );
        self::assertFalse($trackSet->equals($otherTrackSet));
    }

    public function getTrackSetJson()
    {
        return [
            [
                "extension_attributes" => [],
                "track_number" => "t1",
                "title" => "Track 1",
                "carrier_code" => "string"
            ],
            [
                "extension_attributes" => [],
                "track_number" => "t2",
                "title" => "Track 2",
                "carrier_code" => "Track 2"
            ],
        ];
    }

}