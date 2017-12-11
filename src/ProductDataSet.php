<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Command\DeleteProductCommand;
use SnowIO\Magento2DataModel\Command\SaveProductCommand;

final class ProductDataSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(ProductData $productData): self
    {
        $result = clone $this;
        $key = self::getKey($productData);
        $result->items[$key] = $productData;
        return $result;
    }

    public function mapToSaveCommands(float $timestamp): array
    {
        return \array_map(function (ProductData $product) use ($timestamp) {
            return SaveProductCommand::of($product)->withTimestamp($timestamp);
        }, $this->items);
    }

    public function mapToDeleteCommands(float $timestamp): array
    {
        return \array_map(function (ProductData $product) use ($timestamp) {
            return DeleteProductCommand::of($product->getSku())->withTimestamp($timestamp);
        }, $this->items);
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
