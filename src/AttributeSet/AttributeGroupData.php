<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\AttributeSet;

final class AttributeGroupData
{
    public static function of(string $code, string $name): self
    {
        $attributeGroup = new self;
        $attributeGroup->code = $code;
        $attributeGroup->name = $name;
        $attributeGroup->attributes = AttributeDataSet::create();
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

    public function withAttribute(AttributeData $attributeData): self
    {
        $result = clone $this;
        $result->attributes = $result->attributes->with($attributeData);
        return $result;
    }

    public function getAttribute(string $attributeCode): ?AttributeData
    {
        return $this->attributes->get($attributeCode);
    }

    public function withAttributes(AttributeDataSet $attributeDataSet): self
    {
        $result = clone $this;
        $result->attributes = $attributeDataSet;
        return $result;
    }

    public function getAttributes(): AttributeDataSet
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
        return $otherAttributeGroup instanceof AttributeGroupData &&
        $otherAttributeGroup->code === $this->code &&
        $otherAttributeGroup->name === $this->name &&
        $otherAttributeGroup->sortOrder === $this->sortOrder &&
        $otherAttributeGroup->attributes->equals($this->attributes);
    }

    private $code;
    private $name;
    private $sortOrder = 1;
    /** @var AttributeDataSet $attributes */
    private $attributes;

    private function __construct()
    {

    }
}
