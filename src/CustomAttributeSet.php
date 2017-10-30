<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CustomAttributeSet implements \IteratorAggregate
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

    public function toJson(): array
    {
        return array_map(function (CustomAttribute $customAttribute) {
            return $customAttribute->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(CustomAttribute $customAttribute, CustomAttribute $otherCustomAttribute): bool
    {
        return $customAttribute->equals($otherCustomAttribute);
    }
}
