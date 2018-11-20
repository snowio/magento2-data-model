<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class StatusHistoryData implements ValueObject
{
    public static function of(string $parentId, string $comment = '', int $isCustomerNotified = 0): self
    {
        return new self($parentId, $comment, $isCustomerNotified);
    }
    
    public static function fromJson(array $json): self
    {
        $result = self::of((string) $json['parent_id'], $json['comment'], $json['is_customer_notified']);
        $result->createdAt = $json['created_at'] ?? null;
        $result->entityId = (string) ($json['entity_id'] ?? null);
        $result->entityName = $json['entity_name'] ?? null;
        $result->isVisibleOnFront = $json['is_visible_on_front'] ?? null;
        $result->status = $json['status'] ?? null;
        $result->extensionAttributes = ExtensionAttributeSet::of($json['extension_attributes'] ?? []) ;
        return $result;
    }

    private $comment;
    private $createdAt;
    private $entityId;
    private $entityName;
    private $isCustomerNotified;
    private $isVisibleOnFront;
    private $parentId;
    private $status;
    private $extensionAttributes;

    public function withCreatedAt(string $createdAt): self
    {
        $result = clone $this;
        $result->createdAt = $createdAt;
        return $result;
    }

    public function withEntityId(string $entityId): self
    {
        $result = clone $this;
        $result->entityId = $entityId;
        return $result;
    }

    public function withEntityName(string $entityName): self
    {
        $result = clone $this;
        $result->entityName = $entityName;
        return $result;
    }

    public function withIsVisibleOnFront(int $isVisibleOnFront): self
    {
        $result = clone $this;
        $result->isVisibleOnFront = $isVisibleOnFront;
        return $result;
    }

    public function withStatus(string $status): self
    {
        $result = clone $this;
        $result->status = $status;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    public function getEntityName() : ?string
    {
        return $this->entityName;
    }

    public function getIsCustomerNotified(): int
    {
        return $this->isCustomerNotified;
    }

    public function getIsVisibleOnFront(): int
    {
        return $this->isVisibleOnFront;
    }

    public function getParentId() : string
    {
        return $this->parentId;
    }

    public function getStatus() : ?string
    {
        return $this->status;
    }

    public function getExtensionAttributes() : ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function toJson()
    {
        return [
            "comment" => $this->comment,
            "created_at" => $this->createdAt,
            "entity_id" => $this->entityId,
            "entity_name" => $this->entityName,
            "is_customer_notified" => $this->isCustomerNotified,
            "is_visible_on_front" => $this->isVisibleOnFront,
            "parent_id" => $this->parentId,
            "status" => $this->status,
            "extension_attributes" => $this->extensionAttributes->toJson(),
        ];
    }
    
    private function __construct(string $parentId, string $comment, int $isCustomerNotified)
    {
        $this->parentId = $parentId;
        $this->isCustomerNotified = $isCustomerNotified;
        $this->comment = $comment;
        $this->isVisibleOnFront = 0;
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }

    public function equals($other): bool
    {
        return $other instanceof self
        && $this->comment === $other->comment
        && $this->createdAt === $other->createdAt
        && $this->entityId === $other->entityId
        && $this->entityName === $other->entityName
        && $this->isCustomerNotified === $other->isCustomerNotified
        && $this->isVisibleOnFront === $other->isVisibleOnFront
        && $this->parentId === $other->parentId
        && $this->status === $other->status
        && $this->extensionAttributes->equals($other->extensionAttributes);
    }
}
