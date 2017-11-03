<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;
use SnowIO\Magento2DataModel\Command\SaveAttributeOptionCommand;

final class AttributeOptionSet implements \IteratorAggregate
{
    use SetTrait;

    public function with(AttributeOption $attributeOption): self
    {
        $result = clone $this;
        $key = self::getKey($attributeOption);
        $result->items[$key] = $attributeOption;
        return $result;
    }

    public function mapToSaveCommands(float $timestamp): array
    {
        return \array_map(function (AttributeOption $attributeOption) use ($timestamp) {
            return SaveAttributeOptionCommand::of($attributeOption)->withTimestamp($timestamp);
        }, $this->items);
    }

    public function mapToDeleteCommands(float $timestamp): array
    {
        return \array_map(function (AttributeOption $attributeOption) use ($timestamp) {
            return DeleteAttributeOptionCommand::of($attributeOption->getAttributeCode(), $attributeOption->getValue())
                ->withTimestamp($timestamp);
        }, $this->items);
    }

    private static function getKey(AttributeOption $attributeOption): string
    {
        return "{$attributeOption->getAttributeCode()} {$attributeOption->getValue()}";
    }

    private static function itemsAreEqual(AttributeOption $attributeOption, AttributeOption $otherAttributeOption): bool
    {
        return $attributeOption->equals($otherAttributeOption);
    }
}
