<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ExtensionAttributeSet implements \IteratorAggregate
{
    use SetTrait;

    public function withExtensionAttribute(ExtensionAttribute $extensionAttribute): self
    {
        $result = clone $this;
        $key = self::getKey($extensionAttribute);
        $result->items[$key] = $extensionAttribute;
        return $result;
    }

    private static function getKey(ExtensionAttribute $extensionAttribute): string
    {
        return $extensionAttribute->getCode();
    }

    public function toJson(): array
    {
        $extensionAttributes = [];
        /** @var ExtensionAttribute $item */
        foreach ($this->items as $item) {
            $extensionAttributes += $item->toJson();
        }

        return $extensionAttributes;
    }

    private static function itemsAreEqual(ExtensionAttribute $extensionAttribute, ExtensionAttribute $otherExtensionAttribute): bool
    {
        return $extensionAttribute->equals($otherExtensionAttribute);
    }
}