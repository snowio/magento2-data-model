<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Comment implements ValueObject
{
    /** @var string $comment */
    private $comment;
    /** @var int $isCustomerNotified */
    private $isCustomerNotified;
    /** @var int $isVisibleOnFront */
    private $isVisibleOnFront;
    /** @var int $parentId */
    private $parentId;
    /** @var string|null $createdAt */
    private $createdAt;
    /** @var int|null $entityId */
    private $entityId;
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
        $result->comment = $json['comment'];
        $result->isCustomerNotified = $json['is_customer_notified'];
        $result->isVisibleOnFront = $json['is_visible_on_front'];
        $result->parentId = $json['parent_id'];
        $result->createdAt = $json['created_at'] ?? null;
        $result->entityId = $json['entity_id'] ?? null;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function withComment(string $comment): Comment
    {
        $clone = clone $this;
        $clone->comment = $comment;
        return $clone;
    }

    /**
     * @return int
     */
    public function getIsCustomerNotified(): int
    {
        return $this->isCustomerNotified;
    }

    /**
     * @param int $isCustomerNotified
     * @return Comment
     */
    public function withIsCustomerNotified(int $isCustomerNotified): Comment
    {
        $clone = clone $this;
        $clone->isCustomerNotified = $isCustomerNotified;
        return $clone;
    }

    /**
     * @return int
     */
    public function getIsVisibleOnFront(): int
    {
        return $this->isVisibleOnFront;
    }

    /**
     * @param int $isVisibleOnFront
     * @return Comment
     */
    public function withIsVisibleOnFront(int $isVisibleOnFront): Comment
    {
        $clone = clone $this;
        $clone->isVisibleOnFront = $isVisibleOnFront;
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
     * @return Comment
     */
    public function withParentId(int $parentId): Comment
    {
        $clone = clone $this;
        $clone->parentId = $parentId;
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
     * @return Comment
     */
    public function withCreatedAt(?string $createdAt): Comment
    {
        $clone = clone $this;
        $clone->createdAt = $createdAt;
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
     * @return Comment
     */
    public function withEntityId(?int $entityId): Comment
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
     * @return Comment
     */
    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): Comment
    {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
        return $clone;
    }
    
    public function toJson() : array
    {
        $json = [];

        if ($this->getComment()) {
            $json['comment'] = $this->getComment();
        }
        if ($this->getIsCustomerNotified()) {
            $json['is_customer_notified'] = $this->getIsCustomerNotified();
        }
        if ($this->getIsVisibleOnFront()) {
            $json['is_visible_on_front'] = $this->getIsVisibleOnFront();
        }
        if ($this->getParentId()) {
            $json['parent_id'] = $this->getParentId();
        }
        if ($this->getCreatedAt()) {
            $json['created_at'] = $this->getCreatedAt();
        }
        if ($this->getEntityId()) {
            $json['entity_id'] = $this->getEntityId();
        }
        if (!$this->getExtensionAttributes()->isEmpty()) {
            $json['extension_attributes'] = $this->extensionAttributes->toJson();
        }
        
        return $json;
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->comment === $other->comment &&
            $this->isCustomerNotified === $other->isCustomerNotified &&
            $this->isVisibleOnFront === $other->isVisibleOnFront &&
            $this->parentId === $other->parentId &&
            $this->createdAt === $other->createdAt &&
            $this->entityId === $other->entityId &&
            $this->extensionAttributes->equals($other->extensionAttributes);
    }

    protected function __construct()
    {
    }
}
