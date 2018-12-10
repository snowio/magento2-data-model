<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\Collection;

final class ItemDataCollection extends Collection
{

    public function with(ItemData $itemData): self
    {
        $result = clone $this;
        $result->items[] = $itemData;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $item) {
            $result->items[] = ItemData::fromJson($item);
        }
        return $result;
    }

    public function toJson(): array
    {
        return \array_values(\array_map(function (ItemData $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($package, $otherPackageData): bool
    {
        return $package instanceof ItemData
        && $otherPackageData instanceof ItemData
        && $package->equals($otherPackageData);
    }
}
