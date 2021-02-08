<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\SetTrait;
use SnowIO\Magento2DataModel\ValueObject;

final class PackageSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(Package $item): self
    {
        $result = clone $this;
        $result->items[] = $item;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $package) {
            $result = $result->with(Package::fromJson($package));
        }
        return $result;
    }

    public function toJson(): array
    {
        return array_map(function (Package $package) {
            return $package->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(Package $package, Package $otherPackage) : bool
    {
        return $package->equals($otherPackage);
    }
}
