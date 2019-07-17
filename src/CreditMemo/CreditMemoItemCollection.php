<?php
namespace SnowIO\Magento2DataModel\CreditMemo;

use SnowIO\Magento2DataModel\Collection;

class CreditMemoItemCollection extends Collection
{
    public function with(CreditMemoItemData $itemData): self
    {
        $result = clone $this;
        $result->items[] = $itemData;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $item) {
            $result->items[] = CreditMemoItemData::fromJson($item);
        }
        return $result;
    }

    public function toJson(): array
    {
        return \array_values(\array_map(function (CreditMemoItemData $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($item, $otherItemData): bool
    {
        return $item instanceof CreditMemoItemData
            && $otherItemData instanceof CreditMemoItemData
            && $item->equals($otherItemData);
    }
}