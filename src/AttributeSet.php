<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class AttributeSet
{

    public static function of(string $code, string $name): self
    {
        $result = new self;
        $result->code = $code;
        $result->name = $name;
        $result->entityTypeCode = EntityTypeCode::CATALOG_PRODUCT;
        $result->attributeGroups = AttributeGroupSet::create();
        return $result;
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

    public function withEntityTypeCode(string $entityTypeCode): self
    {
        EntityTypeCode::validateEntityTypeCode($entityTypeCode);
        $result = clone $this;
        $result->entityTypeCode = $entityTypeCode;
        return $result;
    }

    public function getEntityTypeCode(): string
    {
        return $this->entityTypeCode;
    }

    public function withAttributeGroup(AttributeGroup $attributeGroup): self
    {
        $result = clone $this;
        $result->attributeGroups = $result->attributeGroups->with($attributeGroup);
        return $result;
    }

    public function getAttributeGroup(string $attributeGroupCode): ?AttributeGroup
    {
        return $this->attributeGroups->get($attributeGroupCode);
    }

    public function withAttributeGroups(AttributeGroupSet $attributeGroups): self
    {
        $result = clone $this;
        $result->attributeGroups = $attributeGroups;
        return $result;
    }

    public function getAttributeGroups(): AttributeGroupSet
    {
        return $this->attributeGroups;
    }

    public function toJson(): array
    {
        return [
            'attribute_set_code' => $this->code,
            'name' => $this->name,
            'entity_type_code' => $this->entityTypeCode,
            'attribute_groups' => $this->attributeGroups->toJson(),
        ];
    }

    public function equals($otherAttributeSet): bool
    {
        return $otherAttributeSet instanceof AttributeSet &&
        $otherAttributeSet->code === $this->code &&
        $otherAttributeSet->name === $this->name &&
        $otherAttributeSet->entityTypeCode === $this->entityTypeCode &&
        $otherAttributeSet->attributeGroups->equals($this->attributeGroups);
    }

    private $code;
    private $name;
    private $entityTypeCode;
    /** @var AttributeGroupSet */
    private $attributeGroups;

    private function __construct()
    {

    }
}
