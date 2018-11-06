<?php
namespace SnowIO\Magento2DataModel;

final class SpecialPriceSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withSpecialPrice(SpecialPrice $specialPrice): self
    {
        $result = clone $this;
        $key = self::getKey($specialPrice);
        $result->items[$key] = $specialPrice;
        return $result;
    }
    
    public function toJson(): array
    {
        return array_map(function (SpecialPrice $specialPrice) {
            return $specialPrice->toJson();
        }, array_values($this->items));
    }

    private function __construct()
    {
    }

    public function get(string $key): ?SpecialPrice
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(SpecialPrice $specialPrice): string
    {
        return sprintf('%s-%s',
            str_replace(' ', '_', $specialPrice->getPriceFrom()),
            str_replace(' ', '_', $specialPrice->getPriceTo())
        );
    }

    private static function itemsAreEqual(
        SpecialPrice $specialPrice,
        SpecialPrice $otherSpecialPrice
    ) : bool {
        return $specialPrice->equals($otherSpecialPrice);
    }
}
