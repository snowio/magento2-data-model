<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\Collection;

final class StatusHistoryDataCollection extends Collection
{

    public function with(StatusHistoryData $statusHistoryDataSet): self
    {
        $result = clone $this;
        $result->items[] = $statusHistoryDataSet;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $statusHistoryJson) {
            $result->items[] = StatusHistoryData::fromJson($statusHistoryJson);
        }

        return $result;
    }

    public function toJson(): array
    {
        return \array_values(array_map(function (StatusHistoryData $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($item, $otherItemData): bool
    {
        return $item instanceof StatusHistoryData
        && $otherItemData instanceof StatusHistoryData
        && $item->equals($otherItemData);
    }
}
