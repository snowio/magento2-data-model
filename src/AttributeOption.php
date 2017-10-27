<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeOption
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

    public function toJson(): array
    {
        return [
            'entity_type' => self::PRODUCT_ENTITY_TYPE,
            'attribute_code' => $this->attributeCode,
            'option' => [
                'value' => $this->value,
                'label' => $this->label,
            ],
        ];
    }

    public function equals($attributeOption): bool
    {
        return $attributeOption instanceof AttributeOption &&
            ($this->attributeCode === $attributeOption->attributeCode) &&
            ($this->value === $attributeOption->value) &&
            ($this->label === $attributeOption->label);
    }

    private $attributeCode;
    private $value;
    private $label;

    private function __construct(string $attributeCode, string $value, string $label)
    {
        $this->attributeCode = $attributeCode;
        $this->value = $value;
        $this->label = $label;
    }
}
