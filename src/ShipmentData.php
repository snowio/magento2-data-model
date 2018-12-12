<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Shipment\TrackSet;

final class ShipmentData implements ValueObject
{
    public static function create(): self
    {
        $result = new self();
        $result->tracks = TrackSet::create();
        return $result;
    }

    public function getTracks(): TrackSet
    {
        return $this->tracks;
    }

    public function withTracks(TrackSet $tracks): self
    {
        $result = clone $this;
        $result->tracks = $tracks;
        return $result;
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

    public function equals($other): bool
    {
        return $other instanceof $this &&
            $this->tracks->equals($other->tracks);
    }
}
