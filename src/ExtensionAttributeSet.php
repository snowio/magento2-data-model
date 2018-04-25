<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ExtensionAttributeSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withExtensionAttribute(ExtensionAttribute $extensionAttribute): self
    {
        $result = clone $this;
        $key = self::getKey($extensionAttribute);
        $result->items[$key] = $extensionAttribute;
        return $result;
    }

    public function deleteExtensionAttribute(ExtensionAttribute $extensionAttribute): self
    {
        $result = clone $this;
        $key = self::getKey($extensionAttribute);
        unset($result->items[$key]);
        return $result;
    }

    public function get(string $key): ?ExtensionAttribute
    {
        return $this->items[$key] ?? null;
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

    public static function fromJson(array $json): self
    {
        $items = [];
        foreach ($json as $code => $value) {
            $items[] = ExtensionAttribute::fromJson([$code => $value]);
        }

        return self::of($items);
    }

    private static function itemsAreEqual(
        ExtensionAttribute $extensionAttribute,
        ExtensionAttribute $otherExtensionAttribute
    ) : bool {
        return $extensionAttribute->equals($otherExtensionAttribute);
    }
}
