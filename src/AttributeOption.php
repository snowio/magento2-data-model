<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeOption implements ValueObject
{
    private const PRODUCT_ENTITY_TYPE = 4;

    public static function of(string $attributeCode, string $value, string $label): self
    {
        $attributeOption = new self($attributeCode, $value, $label);
        return $attributeOption;
    }

    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function withLabel(string $label): self
    {
        $result = clone $this;
        $result->label = $label;
        return $result;
    }

    public function withStoreLabels(AttributeOptionStoreLabelSet $storeLabels)
    {
        $result = clone $this;
        $result->storeLabels = $storeLabels;
        return $result;
    }

    public function withSortOrder(int $sortOrder)
    {
        $result = clone $this;
        $result->sortOrder = $sortOrder;
        return $result;
    }

    public function toJson(): array
    {
        $json = [
            'entity_type' => self::PRODUCT_ENTITY_TYPE,
            'attribute_code' => $this->attributeCode,
            'option' => [
                'value' => $this->value,
                'label' => $this->label,
            ],
        ];

        if ($this->sortOrder) {
            $json['option']['sort_order'] = $this->sortOrder;
        }

        if (!$this->storeLabels->isEmpty()) {
            $json['option']['store_labels'] =  $this->storeLabels->toJson();
        }

        return $json;
    }

    public function equals($attributeOption): bool
    {
        return $attributeOption instanceof AttributeOption &&
            ($this->attributeCode === $attributeOption->attributeCode) &&
            ($this->value === $attributeOption->value) &&
            ($this->label === $attributeOption->label) &&
            ($this->storeLabels->equals($attributeOption->storeLabels));
    }

    private $attributeCode;
    private $value;
    private $label;
    private $storeLabels;
    private $sortOrder;

    private function __construct(string $attributeCode, string $value, string $label)
    {
        $this->attributeCode = $attributeCode;
        $this->value = $value;
        $this->label = $label;
        $this->storeLabels = AttributeOptionStoreLabelSet::create();
    }
}
