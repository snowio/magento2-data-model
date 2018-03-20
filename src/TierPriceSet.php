<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class TierPriceSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withTierPrice(TierPrice $tierPrice): self
    {
        $result = clone $this;
        $key = self::getKey($tierPrice);
        $result->items[$key] = $tierPrice;
        return $result;
    }

    public function get(string $key): ?TierPrice
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(TierPrice $tierPrice): string
    {
        return sprintf('%d-%d', $tierPrice->getCustomerGroupId(), $tierPrice->getQty());
    }

    public function toJson(): array
    {
        return array_map(function (TierPrice $tierPrice) {
            return $tierPrice->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(
        TierPrice $tierPrice,
        TierPrice $otherTierPrice
    ) : bool {
        return $tierPrice->equals($otherTierPrice);
    }
}
