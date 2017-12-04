<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class AttributeGroup
{
    public static function of(string $code, string $name): self
    {
        $attributeGroup = new self;
        $attributeGroup->code = $code;
        $attributeGroup->sortOrder = 1;
        $attributeGroup->name = $name;
        $attributeGroup->attributes = FamilyAttributeDataSet::create();
        return $attributeGroup;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withSortOrder(int $sortOrder): self
    {
        $result = clone $this;
        $result->sortOrder = $sortOrder;
        return $result;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function withAttribute(FamilyAttributeData $familyAttributeData): self
    {
        $result = clone $this;
        $result->attributes = $result->attributes->with($familyAttributeData);
        return $result;
    }

    public function getAttribute(string $attributeCode): ?FamilyAttributeData
    {
        return $this->attributes->get($attributeCode);
    }

    public function withAttributes(FamilyAttributeDataSet $familyAttributeDataSet): self
    {
        $result = clone $this;
        $result->attributes = $familyAttributeDataSet;
        return $result;
    }

    public function getAttributes(): FamilyAttributeDataSet
    {
        return $this->attributes;
    }

    public function toJson(): array
    {
        return [
            'attribute_group_code' => $this->code,
            'name' => $this->name,
            'sort_order' => $this->sortOrder,
            'attributes' => $this->attributes->toJson()
        ];
    }

    public function equals($otherAttributeGroup): bool
    {
        return $otherAttributeGroup instanceof AttributeGroup &&
        $otherAttributeGroup->code === $this->code &&
        $otherAttributeGroup->name === $this->name &&
        $otherAttributeGroup->sortOrder === $this->sortOrder &&
        $otherAttributeGroup->attributes->equals($this->attributes);
    }

    private $code;
    private $name;
    private $sortOrder;
    /** @var FamilyAttributeDataSet $attributes */
    private $attributes;

    private function __construct()
    {

    }
}