<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Item implements ValueObject
{
    /** @var string|null $additionalData */
    private $additionalData;
    /** @var string|null $description */
    private $description;
    /** @var int|null $entityId */
    private $entityId;
    /** @var ExtensionAttributeSet|null */
    private $extensionAttributes;
    /** @var string|null $name */
    private $name;
    /** @var int $orderItemId */
    private $orderItemId;
    /** @var int|null $parentId */
    private $parentId;
    /** @var float|null $price */
    private $price;
    /** @var int|null $productId */
    private $productId;
    /** @var int $qty */
    private $qty;
    /** @var float|null $rowTotal */
    private $rowTotal;
    /** @var string|null $sku */
    private $sku;
    /** @var float|null $weight */
    private $weight;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->additionalData = $json['additional_data'] ?? null;
        $result->description = $json['description'] ?? null;
        $result->entityId = $json['entity_id'] ?? null;
        $result->extensionAttributes = isset($json['extension_attributes']) ?
            ExtensionAttributeSet::fromJson($json['extension_attributes']) :
            null;
        $result->name = $json['name'] ?? null;
        $result->orderItemId = $json['order_item_id'];
        $result->parentId = $json['parent_id'] ?? null;
        $result->price = $json['price'] ?? null;
        $result->productId = $json['product_id'] ?? null;
        $result->qty = $json['qty'];
        $result->rowTotal = $json['row_total'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->weight = $json['weight'] ?? null;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getAdditionalData(): ?string
    {
        return $this->additionalData;
    }

    /**
     * @param string|null $additionalData
     * @return Item
     */
    public function withAdditionalData(?string $additionalData): Item
    {
        $clone = clone $this;
        $clone->additionalData = $additionalData;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Item
     */
    public function withDescription(?string $description): Item
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
     * @return Item
     */
    public function withEntityId(?int $entityId): Item
    {
        $clone = clone $this;
        $clone->entityId = $entityId;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Item
     */
    public function withName(?string $name): Item
    {
        $clone = clone $this;
        $clone->name = $name;
        return $clone;
    }

    /**
     * @return int
     */
    public function getOrderItemId(): int
    {
        return $this->orderItemId;
    }

    /**
     * @param int $orderItemId
     * @return Item
     */
    public function withOrderItemId(int $orderItemId): Item
    {
        $clone = clone $this;
        $clone->orderItemId = $orderItemId;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     * @return Item
     */
    public function withParentId(?int $parentId): Item
    {
        $clone = clone $this;
        $clone->parentId = $parentId;
        return $clone;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return Item
     */
    public function withPrice(?float $price): Item
    {
        $clone = clone $this;
        $clone->price = $price;
        return $clone;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     * @return Item
     */
    public function withProductId(?int $productId): Item
    {
        $clone = clone $this;
        $clone->productId = $productId;
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
     * @return float|null
     */
    public function getRowTotal(): ?float
    {
        return $this->rowTotal;
    }

    /**
     * @param float|null $rowTotal
     * @return Item
     */
    public function withRowTotal(?float $rowTotal): Item
    {
        $clone = clone $this;
        $clone->rowTotal = $rowTotal;
        return $clone;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return Item
     */
    public function withSku(?string $sku): Item
    {
        $clone = clone $this;
        $clone->sku = $sku;
        return $clone;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     * @return Item
     */
    public function withWeight(?float $weight): Item
    {
        $clone = clone $this;
        $clone->weight = $weight;
        return $clone;
    }

    public function getExtensionAttributes()
    {
        return $this->extensionAttributes;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }
    
    public function toJson() : array
    {
        return [
            'additional_data' => $this->additionalData ?? null,
            'description' => $this->description ?? null,
            'entity_id' => $this->entityId ?? null,
            'extension_attributes' => $this->extensionAttributes ? $this->extensionAttributes->toJson() : null,
            'name' => $this->name ?? null,
            'order_item_id' => $this->orderItemId,
            'parent_id' => $this->parentId ?? null,
            'price' => $this->price ?? null,
            'product_id' => $this->productId ?? null,
            'qty' => $this->qty,
            'row_total' => $this->rowTotal ?? null,
            'sku' => $this->sku ?? null,
            'weight' => $this->weight ?? null
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->additionalData === $other->additionalData &&
            $this->description === $other->description &&
            $this->entityId === $other->entityId &&
            $this->extensionAttributes->equals($other->extensionAttributes);
            $this->name === $other->name &&
            $this->orderItemId === $other->orderItemId &&
            $this->parentId === $other->parentId &&
            $this->price === $other->price &&
            $this->productId === $other->productId &&
            $this->qty === $other->qty &&
            $this->rowTotal === $other->rowTotal &&
            $this->sku === $other->sku &&
            $this->weight === $other->weight;
    }

    protected function __construct()
    {
    }
}
