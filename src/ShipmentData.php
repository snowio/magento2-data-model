<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Shipment\TrackSet;

/**
 * Class ShipmentData
 * @package SnowIO\Magento2DataModel
 * @method TrackSet getTracks()
 * @method ShipmentData withTracks(TrackSet $tracks)
 */
final class ShipmentData extends BaseValueObject
{
    public static function create(): self
    {
        return (new self())
            ->withTracks(TrackSet::create());
    }

    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result->tracks = TrackSet::fromJson($json['tracks'] ?? []);
        return $result;
    }

    /** @var TrackSet $tracks */
    private $tracks;

    public function toJson() : array
    {
        return [
            "tracks" => $this->tracks->toJson(),
        ];
    }
}
