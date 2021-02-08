<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\CommentCollection;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemCollection;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;
use SnowIO\Magento2DataModel\Shipment\TrackSet;

final class ShipmentData implements ValueObject
{
    /** @var int|null $billingAddressId */
    private $billingAddressId;
    /** @var CommentCollection $comments */
    private $comments;
    /** @var string|null $createdAt */
    private $createdAt;
    /** @var int|null $customerId */
    private $customerId;
    /** @var int|null $emailSent */
    private $emailSent;
    /** @var int|null $entityId */
    private $entityId;
    /** @var ExtensionAttributeSet $extensionAttributes */
    private $extensionAttributes;
    /** @var string|null  */
    private $incrementId;
    /** @var ItemCollection $items */
    private $items;
    /** @var int $orderId */
    private $orderId;
    /** @var PackageCollection */
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
        $result->packages = PackageCollection::create();
        $result->items = ItemCollection::create();
        $result->comments = CommentCollection::create();
        return $result;
    }

    /**
     * @return int|null
     */
    public function getBillingAddressId(): ?int
    {
        return $this->billingAddressId;
    }

    /**
     * @param int|null $billingAddressId
     * @return ShipmentData
     */
    public function withBillingAddressId(?int $billingAddressId): ShipmentData
    {
        $clone = clone $this;
        $clone->billingAddressId = $billingAddressId;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return ShipmentData
     */
    public function withCreatedAt(?string $createdAt): ShipmentData
    {
        $clone = clone $this;
        $clone->createdAt = $createdAt;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     * @return ShipmentData
     */
    public function withCustomerId(?int $customerId): ShipmentData
    {
        $clone = clone $this;
        $clone->customerId = $customerId;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getEmailSent(): ?int
    {
        return $this->emailSent;
    }

    /**
     * @param int|null $emailSent
     * @return ShipmentData
     */
    public function withEmailSent(?int $emailSent): ShipmentData
    {
        $clone = clone $this;
        $clone->emailSent = $emailSent;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    /**
     * @param int|null $entityId
     * @return ShipmentData
     */
    public function withEntityId(?int $entityId): ShipmentData
    {
        $clone = clone $this;
        $clone->entityId = $entityId;
        return $clone;
    }

    /**
     * @return \SnowIO\Magento2DataModel\ExtensionAttributeSet
     */
    public function getExtensionAttributes(): \SnowIO\Magento2DataModel\ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    /**
     * @param \SnowIO\Magento2DataModel\ExtensionAttributeSet $extensionAttributes
     * @return ShipmentData
     */
    public function withExtensionAttributes(\SnowIO\Magento2DataModel\ExtensionAttributeSet $extensionAttributes
    ): ShipmentData {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getIncrementId(): ?string
    {
        return $this->incrementId;
    }

    /**
     * @param string|null $incrementId
     * @return ShipmentData
     */
    public function withIncrementId(?string $incrementId): ShipmentData
    {
        $clone = clone $this;
        $clone->incrementId = $incrementId;
        return $clone;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return ShipmentData
     */
    public function withOrderId(int $orderId): ShipmentData
    {
        $clone = clone $this;
        $clone->orderId = $orderId;
        return $clone;
    }

    /**
     * @return CommentCollection
     */
    public function getComments(): CommentCollection
    {
        return $this->comments;
    }

    /**
     * @param CommentCollection $comments
     * @return ShipmentData
     */
    public function withComments(CommentCollection $comments): ShipmentData
    {
        $clone = clone $this;
        $clone->comments = $comments;
        return $clone;
    }

    /**
     * @return ItemCollection
     */
    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    /**
     * @param ItemCollection $items
     * @return ShipmentData
     */
    public function withItems(ItemCollection $items): ShipmentData
    {
        $clone = clone $this;
        $clone->items = $items;
        return $clone;
    }

    /**
     * @return PackageCollection
     */
    public function getPackages(): PackageCollection
    {
        return $this->packages;
    }

    /**
     * @param PackageCollection $packages
     * @return ShipmentData
     */
    public function withPackages(PackageCollection $packages): ShipmentData
    {
        $clone = clone $this;
        $clone->packages = $packages;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getShipmentStatus(): ?int
    {
        return $this->shipmentStatus;
    }

    /**
     * @param int|null $shipmentStatus
     * @return ShipmentData
     */
    public function withShipmentStatus(?int $shipmentStatus): ShipmentData
    {
        $clone = clone $this;
        $clone->shipmentStatus = $shipmentStatus;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getShippingAddressId(): ?int
    {
        return $this->shippingAddressId;
    }

    /**
     * @param int|null $shippingAddressId
     * @return ShipmentData
     */
    public function withShippingAddressId(?int $shippingAddressId): ShipmentData
    {
        $clone = clone $this;
        $clone->shippingAddressId = $shippingAddressId;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getShippingLabel(): ?string
    {
        return $this->shippingLabel;
    }

    /**
     * @param string|null $shippingLabel
     * @return ShipmentData
     */
    public function withShippingLabel(?string $shippingLabel): ShipmentData
    {
        $clone = clone $this;
        $clone->shippingLabel = $shippingLabel;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int|null $storeId
     * @return ShipmentData
     */
    public function withStoreId(?int $storeId): ShipmentData
    {
        $clone = clone $this;
        $clone->storeId = $storeId;
        return $clone;
    }

    /**
     * @return float|null
     */
    public function getTotalQty(): ?float
    {
        return $this->totalQty;
    }

    /**
     * @param float|null $totalQty
     * @return ShipmentData
     */
    public function withTotalQty(?float $totalQty): ShipmentData
    {
        $clone = clone $this;
        $clone->totalQty = $totalQty;
        return $clone;
    }

    /**
     * @return float|null
     */
    public function getTotalWeight(): ?float
    {
        return $this->totalWeight;
    }

    /**
     * @param float|null $totalWeight
     * @return ShipmentData
     */
    public function withTotalWeight(?float $totalWeight): ShipmentData
    {
        $clone = clone $this;
        $clone->totalWeight = $totalWeight;
        return $clone;
    }

    /**
     * @return TrackSet
     */
    public function getTracks(): TrackSet
    {
        return $this->tracks;
    }

    /**
     * @param TrackSet $tracks
     * @return ShipmentData
     */
    public function withTracks(TrackSet $tracks): ShipmentData
    {
        $clone = clone $this;
        $clone->tracks = $tracks;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return ShipmentData
     */
    public function withUpdatedAt(?string $updatedAt): ShipmentData
    {
        $clone = clone $this;
        $clone->updatedAt = $updatedAt;
        return $clone;
    }

    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result->billingAddressId = $json['billing_address_id'] ?? null;
        $result->comments = CommentCollection::fromJson($json['comments']);
        $result->createdAt = $json['created_at'] ?? null;
        $result->customerId = $json['customer_id'] ?? null;
        $result->emailSent = $json['email_sent'] ?? null;
        $result->entityId = $json['entity_id'] ?? null;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extenstion_attributes'] ?? []);
        $result->incrementId = $json['increment_id'] ?? null;
        $result->items = ItemCollection::fromJson($json['items']);
        $result->orderId = $json['order_id'];
        $result->packages = PackageCollection::fromJson($json['packages'] ?? []);
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
            "comments" => $this->comments->toJson(),
            "created_at" => $this->createdAt ?? null,
            "customer_id" => $this->customerId ?? null,
            "email_sent" => $this->emailSent ?? null,
            "entity_id" => $this->entityId ?? null,
            "extension_attributes" => $this->extensionAttributes->toJson(),
            "increment_id" => $this->incrementId ?? null,
            "items" => $this->items->toJson(),
            "order_id" => $this->orderId,
            "packages" => $this->packages->toJson(),
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
            $this->comments->equals($other->comments) &&
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
