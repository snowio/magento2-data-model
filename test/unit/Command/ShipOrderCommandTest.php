<?php
namespace SnowIO\Magento2DataModel\Test;
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\ShipOrderCommand;
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
        );

        self::assertEquals([
            'orderIncrementId' => 323323,
            'items' => [],
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
            '@commandGroupId' => 'ship_order.order.323323'
        ], $command->toJson());
    }
}