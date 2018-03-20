<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class TierPrice implements ValueObject
{
    private $customerGroupId;
    private $qty;
    private $value;

    /** @var $extensionAttributes ExtensionAttributeSet */
    private $extensionAttributes;

    public static function of(int $customerGroupId, int $qty, float $value)
    {
        $tierPriceEntry = new self($customerGroupId, $qty, $value);
        $tierPriceEntry->extensionAttributes = ExtensionAttributeSet::create();
        return $tierPriceEntry;
    }

    public function getCustomerGroupId(): int
    {
        return $this->customerGroupId;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function withCustomerGroupId(string $customerGroupId): self
    {
        $result = clone $this;
        $result->customerGroupId = $customerGroupId;
        return $result;
    }

    public function withQty(int $qty): self
    {
        $result = clone $this;
        $result->qty = $qty;
        return $result;
    }

    public function withValue(string $value): self
    {
        $result = clone $this;
        $result->value = $value;
        return $result;
    }

    public function equals($object): bool
    {
        return ($object instanceof TierPrice) &&
        ($this->customerGroupId === $object->customerGroupId) &&
        ($this->qty === $object->qty) &&
        ($this->value === $object->value);
    }

    public function fromJson($json): TierPrice
    {
        return self::create()
            ->withCustomerGroupId($json['customer_group_id'])
            ->withQty($json['qty'])
            ->withValue($json['value']);
    }

    public function toJson(): array
    {
        return [
            'customer_group_id' => $this->getCustomerGroupId(),
            'qty' => $this->getQty(),
            'value' => $this->getValue(),
            'extension_attributes' => $this->extensionAttributes->toJson()
        ];
    }

    private function __construct(int $customerGroupId, int $qty, float $value)
    {
        $this->customerGroupId = $customerGroupId;
        $this->qty = $qty;
        $this->value = $value;
    }
}