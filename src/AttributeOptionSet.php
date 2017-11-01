<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeOptionSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(AttributeOption $attributeOption): self
    {
        $result = clone $this;
        $key = self::getKey($attributeOption);
        $result->items[$key] = $attributeOption;
        return $result;
    }

    private static function getKey(AttributeOption $attributeOption): string
    {
        return "{$attributeOption->getAttributeCode()} {$attributeOption->getValue()}";
    }

    private static function itemsAreEqual(AttributeOption $attributeOption, AttributeOption $otherAttributeOption): bool
    {
        return $attributeOption->equals($otherAttributeOption);
    }
}
