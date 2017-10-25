<?php
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Internal\SetTrait;

class CustomAttributeSet implements \IteratorAggregate
{
    use SetTrait;

    public function withCustomAttribute(CustomAttribute $customAttribute): self
    {
        $result = clone $this;
        $key = self::getKey($customAttribute);
        $result->items[$key] = $customAttribute;
        return $result;
    }

    private static function getKey(CustomAttribute $customAttribute): string
    {
        return $customAttribute->getCode();
    }

    private static function itemsAreEqual(CustomAttribute $customAttribute, CustomAttribute $otherCustomAttribute): bool
    {
        return $customAttribute->equals($otherCustomAttribute);
    }
}
