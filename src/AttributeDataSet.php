<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(AttributeData $attributeData): self
    {
        $result = clone $this;
        $result->items[$attributeData->getCode()] = $attributeData;
        return $result;
    }

    private static function getKey(AttributeData $attributeData): string
    {
        return $attributeData->getCode();
    }

    private static function itemsAreEqual(AttributeData $attributeData, AttributeData $otherAttributeData): bool
    {
        return $attributeData->equals($otherAttributeData);
    }
}
