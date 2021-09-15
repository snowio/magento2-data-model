<?php
namespace SnowIO\Magento2DataModel\Inventory;

use SnowIO\Magento2DataModel\Command\DeleteSourceItemsCommand;
use SnowIO\Magento2DataModel\Command\SaveSourceItemsCommand;
use SnowIO\Magento2DataModel\MagentoDataException;
use SnowIO\Magento2DataModel\SetTrait;

class SourceItemDataSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(SourceItemData $sourceItem): self
    {
        $result = clone $this;
        $key = self::getKey($sourceItem);
        if (isset($result->items[$key])) {
            throw new MagentoDataException("Source items must be unique");
        }

        $result->items[$key] = $sourceItem;
        return $result;
    }

    public function mapToSaveCommand(int $timestamp): SaveSourceItemsCommand
    {
        return SaveSourceItemsCommand::of(clone $this)->withTimestamp($timestamp);
    }

    public function mapToDeleteCommand(int $timestamp): DeleteSourceItemsCommand
    {
        return DeleteSourceItemsCommand::of(clone $this)->withTimestamp($timestamp);
    }

    private static function getKey(SourceItemData $sourceItem)
    {
        return "{$sourceItem->getSku()}-{$sourceItem->getSourceCode()}";
    }

    public function itemsAreEqual(SourceItemData $a, SourceItemData $b): bool
    {
        return $a->equals($b);
    }

    public function toJson(): array
    {
        return array_values(array_map(function (SourceItemData $itemData) {
            return $itemData->toJson();
        },$this->items));
    }
}
