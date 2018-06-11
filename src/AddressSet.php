<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AddressSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withAddress(CustomerAddress $address): self
    {
        $result = clone $this;
        $key = self::getKey($address);
        $result->items[$key] = $address;
        return $result;
    }

    public function get(string $key): ?CustomerAddress
    {
        return $this->items[$key] ?? null;
    }

    private static function getKey(CustomerAddress $address): ?int
    {
        return $address->getId();
    }

    public function toJson(): array
    {
        return array_map(function (CustomerAddress $address) {
            return $address->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(
        CustomerAddress $address,
        CustomerAddress $otherAddress
    ) : bool {
        return $address->equals($otherAddress);
    }
}
