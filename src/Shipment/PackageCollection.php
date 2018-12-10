<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\Collection;

final class PackageCollection extends Collection
{

    public function with(Package $package): self
    {
        $result = clone $this;
        $result->items[] = $package;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $package) {
            $result->items[] = Package::fromJson($package);
        }
        return $result;
    }

    public function toJson(): array
    {
        return array_map(function (Package $package) {
            return $package->toJson();
        }, array_values($this->items));
    }

    protected function isEqual($package, $otherPackage)
    {
        return $package instanceof Package
            && $otherPackage instanceof Package
            && $package->equals($otherPackage);
    }
}