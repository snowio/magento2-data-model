<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Track implements ValueObject
{
    /** @var string $carrierCode */
    private $carrierCode;
    /** @var string $title */
    private $title;
    /** @var string|null */
    private $createdAt;
    /** @var string $description */
    private $description;
    /** @var int|null $entityId */
    private $entityId;
    /** @var ExtensionAttributeSet */
    private $extensionAttributes;
    /** @var int $orderId */
    private $orderId;
    /** @var int $parentId */
    private $parentId;
    /** @var int $qty */
    private $qty;
    /** @var string $trackNumber */
    private $trackNumber;
    /** @var string|null $updatedAt */
    private $updatedAt;
    /** @var float $weight */
    private $weight;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->carrierCode = $json['carrier_code'];
        $result->title = $json['title'];
        $result->createdAt = $json['created_at'] ?? null;
        $result->description = $json['description'];
        $result->entityId = $json['entity_id'] ?? null;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        $result->orderId = $json['order_id'];
        $result->parentId = $json['parent_id'];
        $result->qty = $json['qty'];
        $result->trackNumber = $json['track_number'];
        $result->updatedAt = $json['updated_at'] ?? null;
        $result->weight = $json['weight'];
        return $result;
    }

    /**
     * @return string
     */
    public function getCarrierCode(): string
    {
        return $this->carrierCode;
    }

    /**
     * @param string $carrierCode
     * @return Track
     */
    public function withCarrierCode(string $carrierCode): Track
    {
        $clone = clone $this;
        $clone->carrierCode = $carrierCode;
        return $clone;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Track
     */
    public function withTitle(string $title): Track
    {
        $clone = clone $this;
        $clone->title = $title;
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
     * @return Track
     */
    public function withCreatedAt(?string $createdAt): Track
    {
        $clone = clone $this;
        $clone->createdAt = $createdAt;
        return $clone;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Track
     */
    public function withDescription(string $description): Track
    {
        $clone = clone $this;
        $clone->description = $description;
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
     * @return Track
     */
    public function withEntityId(?int $entityId): Track
    {
        $clone = clone $this;
        $clone->entityId = $entityId;
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
     * @return Track
     */
    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): Track
    {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
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
     * @return Track
     */
    public function withOrderId(int $orderId): Track
    {
        $clone = clone $this;
        $clone->orderId = $orderId;
        return $clone;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     * @return Track
     */
    public function withParentId(int $parentId): Track
    {
        $clone = clone $this;
        $clone->parentId = $parentId;
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
     * @return Track
     */
    public function withQty(int $qty): Track
    {
        $clone = clone $this;
        $clone->qty = $qty;
        return $clone;
    }

    /**
     * @return string
     */
    public function getTrackNumber(): string
    {
        return $this->trackNumber;
    }

    /**
     * @param string $trackNumber
     * @return Track
     */
    public function withTrackNumber(string $trackNumber): Track
    {
        $clone = clone $this;
        $clone->trackNumber = $trackNumber;
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
     * @return Track
     */
    public function withUpdatedAt(?string $updatedAt): Track
    {
        $clone = clone $this;
        $clone->updatedAt = $updatedAt;
        return $clone;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return Track
     */
    public function withWeight(float $weight): Track
    {
        $clone = clone $this;
        $clone->weight = $weight;
        return $clone;
    }
    
    public function toJson() : array
    {
        return [
            'carrier_code' => $this->carrierCode,
            'title' => $this->title,
            'created_at' => $this->createdAt ?? null,
            'description' => $this->description,
            'entity_id' => $this->entityId ?? null,
            'extension_attributes' => $this->extensionAttributes->toJson(),
            'order_id' => $this->orderId,
            'parent_id' => $this->parentId,
            'qty' => $this->qty,
            'track_number' => $this->trackNumber,
            'updated_at' => $this->updatedAt ?? null,
            'weight' => $this->weight ?? null
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->carrierCode === $other->carrierCode &&
            $this->title === $other->title &&
            $this->createdAt === $other->createdAt &&
            $this->description === $other->description &&
            $this->entityId === $other->entityId &&
            $this->extensionAttributes->equals($other->extensionAttributes) &&
            $this->orderId === $other->orderId &&
            $this->parentId === $other->parentId &&
            $this->qty === $other->qty &&
            $this->trackNumber === $other->trackNumber &&
            $this->updatedAt === $other->updatedAt &&
            $this->weight === $other->weight;
    }

    protected function __construct()
    {
    }
}
