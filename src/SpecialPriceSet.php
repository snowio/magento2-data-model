<?php
namespace SnowIO\Magento2DataModel;

final class SpecialPriceSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    /**
     * @param SpecialPrice $specialPrice
     * @return SpecialPriceSet
     */
    public function withSpecialPrice(SpecialPrice $specialPrice): self
    {
        $result = clone $this;
        $key = self::getKey($specialPrice);
        $result->items[$key] = $specialPrice;
        return $result;
    }

    /**
     * @return array
     */
    public function toJson(): array
    {
        return array_map(function (SpecialPrice $specialPrice) {
            return $specialPrice->toJson();
        }, array_values($this->items));
    }

    /**
     * SpecialPriceSet constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $key
     * @return null|SpecialPrice
     */
    public function get(string $key): ?SpecialPrice
    {
        return $this->items[$key] ?? null;
    }

    /**
     * @param SpecialPrice $specialPrice
     * @return string
     */
    private static function getKey(SpecialPrice $specialPrice): string
    {
        return sprintf('%s-%s-%s-%s-%s',
            $specialPrice->getStoreId(),
            $specialPrice->getPrice(),
            $specialPrice->getSku(),
            str_replace(' ', '_', $specialPrice->getPriceFrom()),
            str_replace(' ', '_', $specialPrice->getPriceTo())
        );
    }

    /**
     * @param SpecialPrice $specialPrice
     * @param SpecialPrice $otherSpecialPrice
     * @return bool
     */
    private static function itemsAreEqual(
        SpecialPrice $specialPrice,
        SpecialPrice $otherSpecialPrice
    ) : bool {
        return $specialPrice->equals($otherSpecialPrice);
    }
}
