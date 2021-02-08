<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Shipment\ItemSet;
use SnowIO\Magento2DataModel\Shipment\PackageSet;
use SnowIO\Magento2DataModel\Shipment\TrackSet;
use SnowIO\Magento2DataModel\Shipment\CommentSet;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

final class ShipmentData implements ValueObject
{
    /** @var int|null $billingAddressId */
    private $billingAddressId;
    /** @var CommentSet $comments */
    private $comments;
    /** @var string|null $createdAt */
    private $createdAt;
    /** @var int|null $customerId */
    private $customerId;
    /** @var int|null $emailSent */
    private $emailSent;
    /** @var int|null $entityId */
    private $entityId;
    /** @var ExtensionAttributeSet|null $extensionAttributes */
    private $extensionAttributes;
    /** @var string|null  */
    private $incrementId;
    /** @var ItemSet $items */
    private $items;
    /** @var int $orderId */
    private $orderId;
    /** @var PackageSet|null */
    private $packages;
    /** @var int|null $shipmentStatus */
    private $shipmentStatus;
    /** @var int|null $shippingAddressId */
    private $shippingAddressId;
    /** @var string|null $shippingLabel */
    private $shippingLabel;
    /** @var int|null $storeId */
    private $storeId;
    /** @var float|null $totalQty */
    private $totalQty;
    /** @var float|null $totalWeight */
    private $totalWeight;
    /** @var TrackSet $tracks */
    private $tracks;
    /** @var string|null $updatedAt */
    private $updatedAt;

    public static function create(): self
    {
        $result = new self();
        $result->tracks = TrackSet::create();
        $result->packages = PackageSet::create();
        $result->items = ItemSet::create();
        $result->comments = CommentSet::create();
        return $result;
    }

    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result->billingAddressId = $json['billing_address_id'] ?? null;
        $result->comments = CommentSet::fromJson($json['comments']);
        $result->createdAt = $json['created_at'] ?? null;
        $result->customerId = $json['customer_id'] ?? null;
        $result->emailSent = $json['email_sent'] ?? null;
        $result->entityId = $json['entity_id'] ?? null;
        $result->extensionAttributes = isset($json['extenstion_attributes']) ?
            ExtensionAttributeSet::fromJson($json['extenstion_attributes']) :
            null;
        $result->incrementId = $json['increment_id'] ?? null;
        $result->items = ItemSet::fromJson($json['items']);
        $result->orderId = $json['order_id'];
        $result->packages = isset($json['packages']) ? PackageSet::fromJson($json['packages']) : null;
        $result->shipmentStatus = $json['shipment_status'] ?? null;
        $result->shippingAddressId = $json['shipping_address_id'] ?? null;
        $result->shippingLabel = $json['shipping_label'] ?? null;
        $result->storeId = $json['store_id'] ?? null;
        $result->totalQty = $json['total_qty'] ?? null;
        $result->totalWeight = $json['total_weight'] ?? null;
        $result->tracks = TrackSet::fromJson($json['tracks']);
        return $result;
    }

    public function toJson() : array
    {
        return [
            "billing_address_id" => $this->billingAddressId ?? null,
            "comments" => $this->comments ? $this->comments->toJson() : null,
            "created_at" => $this->createdAt ?? null,
            "customer_id" => $this->customerId ?? null,
            "email_sent" => $this->emailSent ?? null,
            "entity_id" => $this->entityId ?? null,
            "extension_attributes" => $this->extensionAttributes ? $this->extensionAttributes->toJson() : null,
            "increment_id" => $this->incrementId ?? null,
            "items" => $this->items->toJson(),
            "order_id" => $this->orderId,
            "packages" => $this->packages ? $this->packages->toJson() : null,
            "shipment_status" => $this->shipmentStatus ?? null,
            "shipping_address_id" => $this->shippingAddressId ?? null,
            "shipping_label" => $this->shippingLabel ?? null,
            "store_id" => $this->storeId ?? null,
            "total_qty" => $this->totalQty ?? null,
            "total_weight" => $this->totalWeight ?? null,
            "tracks" => $this->tracks->toJson(),
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof $this &&
            $this->billingAddressId === $other->billingAddressId &&
            $this->comments === $other->comments &&
            $this->createdAt === $other->createdAt &&
            $this->customerId === $other->customerId &&
            $this->emailSent === $other->emailSent &&
            $this->entityId === $other->entityId &&
            $this->extensionAttributes->equals($other->extensionAttributes) &&
            $this->incrementId === $other->incrementId &&
            $this->items->equals($other->items) &&
            $this->orderId === $other->orderId &&
            $this->packages->equals($other->packages) &&
            $this->shipmentStatus === $other->shipmentStatus &&
            $this->shippingAddressId === $other->shippingAddressId &&
            $this->shippingLabel === $other->shippingLabel &&
            $this->storeId === $other->storeId &&
            $this->totalQty === $other->totalQty &&
            $this->totalWeight === $other->totalWeight &&
            $this->tracks->equals($other->tracks);
    }
}
