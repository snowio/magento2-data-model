<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductLinkSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withProductLink(ProductLink $productLink): self
    {
        $result = clone $this;
        $key = self::getKey($productLink);
        $result->items[$key] = $productLink;
        return $result;
    }

    public function get(string $key): ?ProductLink
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(ProductLink $productLink): string
    {
        return sprintf('%s-%s', $productLink->getSku(), $productLink->getLinkedProductSku());
    }

    public function toJson(): array
    {
        return array_map(function (ProductLink $productLink) {
            return $productLink->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(
        ProductLink $productLink,
        ProductLink $otherProductLink
    ) : bool {
        return $productLink->equals($otherProductLink);
    }
}
