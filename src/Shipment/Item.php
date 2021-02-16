<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Item implements ValueObject
{
    /** @var string $orderItemId */
    private $orderItemId;
    /** @var int $qty */
    private $qty;
    /** @var ExtensionAttributeSet */
    private $extensionAttributes;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->orderItemId = $json['order_item_id'];
        $result->qty = $json['qty'];
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    /**
     * @return string
     */
    public function getOrderItemId(): string
    {
        return $this->orderItemId;
    }

    /**
     * @param string $orderItemId
     * @return Item
     */
    public function withOrderItemId(string $orderItemId): Item
    {
        $clone = clone $this;
        $clone->orderItemId = $orderItemId;
        return $clone;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     * @return Item
     */
    public function withQty(int $qty): Item
    {
        $clone = clone $this;
        $clone->qty = $qty;
        return $clone;
    }

    /**
     * @return ExtensionAttributeSet
     */
    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    /**
     * @param ExtensionAttributeSet $extensionAttributes
     * @return Item
     */
    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): Item
    {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
        return $clone;
    }
    
    public function toJson() : array
    {
        $json = [];

        $json['order_item_id'] = $this->orderItemId;
        $json['qty'] = $this->qty;

        if (!$this->getExtensionAttributes()->isEmpty()) {
            $json['extension_attributes'] = $this->getExtensionAttributes();
        }

        return $json;
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->orderItemId === $other->orderItemId &&
            $this->qty === $other->qty &&
            $this->extensionAttributes->equals($other->extensionAttributes);
    }

    protected function __construct()
    {
    }
}
