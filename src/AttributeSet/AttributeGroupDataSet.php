<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\AttributeSet;

use SnowIO\Magento2DataModel\SetTrait;

final class AttributeGroupDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(AttributeGroupData $attributeGroup): self
    {
        $result = clone $this;
        $key = self::getKey($attributeGroup);
        $result->items[$key] = $attributeGroup;
        return $result;
    }

    public function get(string $attributeGroupCode): ?AttributeGroupData
    {
        return $this->items[$attributeGroupCode] ?? null;
    }

    private static function getKey(AttributeGroupData $attributeGroup): string
    {
        return $attributeGroup->getCode();
    }

    private static function itemsAreEqual(
        AttributeGroupData $attributeGroup,
        AttributeGroupData $otherAttributeGroup
    ): bool
    {
        return $attributeGroup->equals($otherAttributeGroup);
    }

    public function toJson(): array
    {
        return array_map(function (AttributeGroupData $attributeGroup) {
            return $attributeGroup->toJson();
        }, array_values($this->items));
    }
}
