<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\Collection;

final class ItemCollection extends Collection
{

    public function with(Item $itemData): self
    {
        $result = clone $this;
        $result->items[] = $itemData;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $item) {
            $result->items[] = Item::fromJson($item);
        }
        return $result;
    }

    public function toJson(): array
    {
        return \array_values(\array_map(function (Item $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($item, $otherItemData): bool
    {
        return $item instanceof Item
            && $otherItemData instanceof Item
            && $item->equals($otherItemData);
    }
}
