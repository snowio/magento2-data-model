<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\AttributeSet;

use SnowIO\Magento2DataModel\SetTrait;
use SnowIO\Magento2DataModel\ValueObject;

final class AttributeDataSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(AttributeData $attributeData): self
    {
        $result = clone $this;
        $key = self::getKey($attributeData);
        $result->items[$key] = $attributeData;
        return $result;
    }

    public function get(string $key): ?AttributeData
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(AttributeData $attributeData): string
    {
        return "{$attributeData->getCode()}";
    }

    private static function itemsAreEqual(
        AttributeData $attributeData,
        AttributeData $otherAttributeData
    ): bool
    {
        return $attributeData->equals($otherAttributeData);
    }

    public function toJson()
    {
        return \array_map(function (AttributeData $attributeData) {
            return $attributeData->toJson();
        }, array_values($this->items));
    }
}
