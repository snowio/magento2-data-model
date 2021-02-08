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
        foreach ($json as $item) {
            $result->items[] = Package::fromJson($item);
        }
        return $result;
    }

    public function toJson(): array
    {
        return \array_values(\array_map(function (Package $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($item, $otherPackageData): bool
    {
        return $item instanceof Package
            && $otherPackageData instanceof Package
            && $item->equals($otherPackageData);
    }
}
