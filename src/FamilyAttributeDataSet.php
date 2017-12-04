<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class FamilyAttributeDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(FamilyAttributeData $attributeData): self
    {
        $result = clone $this;
        $key = self::getKey($attributeData);
        $result->items[$key] = $attributeData;
        return $result;
    }

    public function get(string $key): ?FamilyAttributeData
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(FamilyAttributeData $attributeData): string
    {
        return "{$attributeData->getCode()}";
    }

    private static function itemsAreEqual(
        FamilyAttributeData $attributeData,
        FamilyAttributeData $otherAttributeData
    ): bool
    {
        return $attributeData->equals($otherAttributeData);
    }

    public function toJson()
    {
        return \array_map(function (FamilyAttributeData $familyAttributeData) {
            return $familyAttributeData->toJson();
        }, array_values($this->items));
    }
}