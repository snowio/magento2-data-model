<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Command\DeleteAttributeCommand;
use SnowIO\Magento2DataModel\Command\SaveAttributeCommand;

final class AttributeDataSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(AttributeData $attributeData): self
    {
        $result = clone $this;
        $result->items[$attributeData->getCode()] = $attributeData;
        return $result;
    }

    public function mapToSaveCommands(float $timestamp): array
    {
        return array_map(function (AttributeData $attributeData) use ($timestamp) {
            return SaveAttributeCommand::of($attributeData)->withTimestamp($timestamp);
        }, $this->items);
    }

    public function mapToDeleteCommands(float $timestamp): array
    {
        return array_map(function (AttributeData $attributeData) use ($timestamp) {
            return DeleteAttributeCommand::of($attributeData->getCode())->withTimestamp($timestamp);
        }, $this->items);
    }

    private static function getKey(AttributeData $attributeData): string
    {
        return $attributeData->getCode();
    }

    private static function itemsAreEqual(AttributeData $attributeData, AttributeData $otherAttributeData): bool
    {
        return $attributeData->equals($otherAttributeData);
    }
}
