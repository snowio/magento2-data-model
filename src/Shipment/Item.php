<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\BaseValueObject;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

/**
 * Class Item
 * @package SnowIO\Magento2DataModel\Shipment
 * @method ExtensionAttributeSet getExtensionAttributes()
 * @method int getOrderItemId()
 * @method int getQty
 * @method Item withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
 * @method Item withQty(int $qty)
 * @method Item withOrderItemId(int $orderItemId)
 */
final class Item extends BaseValueObject
{

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function of(int $orderItemId, int $qty): self
    {
        return (new self())
            ->withOrderItemId($orderItemId)
            ->withQty($qty)
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        return self::create()
            ->withExtensionAttributes(ExtensionAttributeSet::fromJson(
                $json['extension_attributes'] ?? []
            ))
            ->withQty($json['qty'] ?? 0)
            ->withOrderItemId($json['order_item_id']);
    }

    public function toJson() : array
    {
        return [
            'order_item_id' => $this->getOrderItemId(),
            'qty' => $this->getQty(),
            'extension_attributes' => $this->getExtensionAttributes()->toJson(),
        ];
    }
}