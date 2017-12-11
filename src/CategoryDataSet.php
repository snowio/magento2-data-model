<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Command\DeleteCategoryCommand;
use SnowIO\Magento2DataModel\Command\SaveCategoryCommand;

final class CategoryDataSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(CategoryData $categoryData): self
    {
        $result = clone $this;
        $key = self::getKey($categoryData);
        $result->items[$key] = $categoryData;
        return $result;
    }

    public function mapToSaveCommands(float $timestamp): array
    {
        return \array_map(function (CategoryData $categoryData) use ($timestamp) {
            return SaveCategoryCommand::of($categoryData)->withTimestamp($timestamp);
        }, $this->items);
    }

    public function mapToDeleteCommands(float $timestamp): array
    {
        return \array_map(function (CategoryData $categoryData) use ($timestamp) {
            return DeleteCategoryCommand::of($categoryData->getCode())->withTimestamp($timestamp);
        }, $this->items);
    }

    private static function getKey(CategoryData $categoryData): string
    {
        return "{$categoryData->getCode()} {$categoryData->getStoreCode()}";
    }

    private static function itemsAreEqual(CategoryData $item1, CategoryData $item2): bool
    {
        return $item1->equals($item2);
    }
}
