<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CategoryCodeSet implements \IteratorAggregate, ValueObject
{
    use SetTrait {
        overlaps as private;
    }

    public function with(string $categoryId): self
    {
        $result = clone $this;
        $result->items[$categoryId] = $categoryId;
        return $result;
    }

    public function add(self $otherSet): self
    {
        $result = new self;
        $result->items = \array_merge($this->items, $otherSet->items);
        return $result;
    }

    public function toArray(): array
    {
        return \array_values($this->items);
    }

    private static function getKey(string $categoryCode): string
    {
        return $categoryCode;
    }
}
