<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\SetTrait;
use SnowIO\Magento2DataModel\ValueObject;

final class TrackSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(Track $item): self
    {
        $result = clone $this;
        $key = self::getKey($item);
        $result->items[$key] = $item;
        return $result;
    }

    public function get(string $key): ?Track
    {
        return $this->items[$key] ?? null;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $track) {
            $result = $result->with(Track::fromJson($track));
        }
        return $result;
    }

    public static function getKey(Track $track): string
    {
        return $track->getTrackNumber();
    }

    public function toJson(): array
    {
        return array_map(function (Track $track) {
            return $track->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(Track $track, Track $otherTrack) : bool
    {
        return $track->equals($otherTrack);
    }
}
