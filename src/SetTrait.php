<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

trait SetTrait
{

    /**
     * @return static
     */
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

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self;
    }

    /**
     * @return static
     */
    public function filter(callable $predicate): self
    {
        $result = new self;
        $result->items = \array_filter($this->items, $predicate);
        return $result;
    }

    /**
     * @return static
     */
    public function map(callable $fn): self
    {
        $items = \array_map($fn, $this->items);
        return self::of($items);
    }

    /**
     * @return static
     */
    public function flatMap(callable $fn): self
    {
        $mappedItems = [];
        foreach ($this->items as $item) {
            foreach ($fn($item) as $mappedItem) {
                $mappedItems[] = $mappedItem;
            }
        }
        return self::of($mappedItems);
    }

    /**
     * @return static
     */
    public function add(self $otherSet): self
    {
        if ($otherSet->overlaps($this)) {
            throw new MagentoDataException;
        }
        $result = new self;
        $result->items = \array_merge($this->items, $otherSet->items);
        return $result;
    }

    /**
     * @return static
     */
    public function merge(self $otherSet): self
    {
        $result = new self;
        $result->items = \array_merge($this->items, $otherSet->items);
        return $result;
    }

    /**
     * @return static
     */
    public function diff(self $otherSet): self
    {
        $result = new self;
        foreach ($this->items as $key => $item) {
            $otherItem = $otherSet->items[$key] ?? null;
            if (!isset($otherItem) || !self::itemsAreEqual($item, $otherItem)) {
                $result[$key] = $item;
            }
        }
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
            $otherItem = $object->items[$key] ?? null;
            if ($otherItem === null || !self::itemsAreEqual($item, $otherItem)) {
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
