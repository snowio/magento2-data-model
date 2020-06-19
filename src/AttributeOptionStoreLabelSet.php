<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeOptionStoreLabelSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(AttributeOptionStoreLabel $attributeOptionStoreLabel): self
    {
        $result = clone $this;
        $key = self::getKey($attributeOptionStoreLabel);
        $result->items[$key] = $attributeOptionStoreLabel;
        return $result;
    }

    private static function getKey(AttributeOptionStoreLabel $attributeOptionStoreLabel): string
    {
        return $attributeOptionStoreLabel->getStoreCode();
    }

    public function toJson(): array
    {
        return array_map(function (AttributeOptionStoreLabel $attributeOptionStoreLabel) {
            return $attributeOptionStoreLabel->toJson();
        }, array_values($this->items));
    }


    private static function itemsAreEqual(AttributeOptionStoreLabel $attributeOption, AttributeOptionStoreLabel $otherAttributeOption): bool
    {
        return $attributeOption->equals($otherAttributeOption);
    }
}
