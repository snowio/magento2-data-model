<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

trait SetTrait
{
    public static function of(array $items): self
    {
        $set = new self;
        foreach ($items as $item) {
            try {
                $key = self::getKey($item);
            } catch (\Throwable $e) {
                throw new MagentoDataException;
            }
            if (isset($set->items[$key])) {
                throw new MagentoDataException;
            }
            $set->items[$key] = $item;
        }
        return $set;
    }

    public static function create(): self
    {
        return new self;
    }

    public function add(self $otherSet): self
    {
        if ($otherSet->overlaps($this)) {
            throw new MagentoDataException;
        }
        $result = new self;
        $result->items = \array_merge($this->items, $otherSet->items);
        return $result;
    }

    public function overlaps(self $otherSet): bool
    {
        foreach ($this->items as $key => $item) {
            if (isset($otherSet->items[$key])) {
                return true;
            }
        }
        foreach ($otherSet->items as $key => $item) {
            if (isset($this->items[$key])) {
                return true;
            }
        }
        return false;
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function equals($object): bool
    {
        if (!$object instanceof self) {
            return false;
        }

        if (\count($this->items) != \count($object->items)) {
            return false;
        }

        foreach ($this->items as $key => $item) {
            $otherItem = $object->items[$key];
            if (!self::itemsAreEqual($item, $otherItem)) {
                return false;
            }
        }

        return true;
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }

    private $items = [];

    private function __construct()
    {

    }

    private static function itemsAreEqual($item1, $item2): bool
    {
        return $item1 === $item2;
    }
}