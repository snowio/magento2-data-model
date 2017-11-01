<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CategoryDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(CategoryData $categoryData): self
    {
        $result = clone $this;
        $result->items[$categoryData->getCode()] = $categoryData;
        return $result;
    }

    private static function getKey(CategoryData $categoryData): string
    {
        return $categoryData->getCode();
    }

    private static function itemsAreEqual(CategoryData $item1, CategoryData $item2): bool
    {
        return $item1->equals($item2);
    }
}