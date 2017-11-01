<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(ProductData $productData): self
    {
        $result = clone $this;
        $key = self::getKey($productData);
        $result->items[$key] = $productData;
        return $result;
    }

    private static function getKey(ProductData $productData): string
    {
        return "{$productData->getSku()} {$productData->getStoreCode()}";
    }

    private static function itemsAreEqual(ProductData $productData, ProductData $otherProductData): bool
    {
        return $productData->equals($otherProductData);
    }
}
