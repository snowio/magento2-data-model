<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class AttributeGroupSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(AttributeGroup $attributeGroup): self
    {
        $result = clone $this;
        $key = self::getKey($attributeGroup);
        $result->items[$key] = $attributeGroup;
        return $result;
    }

    public function get(string $attributeGroupCode): ?AttributeGroup
    {
        return $this->items[$attributeGroupCode] ?? null;
    }

    private static function getKey(AttributeGroup $attributeGroup): string
    {
        return $attributeGroup->getCode();
    }

    private static function itemsAreEqual(
        AttributeGroup $attributeGroup,
        AttributeGroup $otherAttributeGroup
    ): bool
    {
        return $attributeGroup->equals($otherAttributeGroup);
    }

    public function toJson(): array
    {
        return array_map(function (AttributeGroup $attributeGroup) {
            return $attributeGroup->toJson();
        }, array_values($this->items));
    }
}