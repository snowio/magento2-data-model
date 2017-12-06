<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupData;
use SnowIO\Magento2DataModel\AttributeSet\AttributeGroupDataSet;

final class AttributeSetData
{
    public static function of(string $entityTypeCode, string $code, string $name): self
    {
        $result = new self;
        $result->entityTypeCode = $entityTypeCode;
        $result->code = $code;
        $result->name = $name;
        $result->attributeGroups = AttributeGroupDataSet::create();
        return $result;
    }

    public function getEntityTypeCode(): string
    {
        return $this->entityTypeCode;
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

    public function withAttributeGroup(AttributeGroupData $attributeGroup): self
    {
        $result = clone $this;
        $result->attributeGroups = $result->attributeGroups->with($attributeGroup);
        return $result;
    }

    public function getAttributeGroup(string $attributeGroupCode): ?AttributeGroupData
    {
        return $this->attributeGroups->get($attributeGroupCode);
    }

    public function withAttributeGroups(AttributeGroupDataSet $attributeGroups): self
    {
        $result = clone $this;
        $result->attributeGroups = $attributeGroups;
        return $result;
    }

    public function getAttributeGroups(): AttributeGroupDataSet
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
        return $otherAttributeSet instanceof AttributeSetData &&
        $otherAttributeSet->code === $this->code &&
        $otherAttributeSet->name === $this->name &&
        $otherAttributeSet->entityTypeCode === $this->entityTypeCode &&
        $otherAttributeSet->attributeGroups->equals($this->attributeGroups);
    }

    private $code;
    private $name;
    private $entityTypeCode;
    /** @var AttributeGroupDataSet */
    private $attributeGroups;

    private function __construct()
    {

    }
}
