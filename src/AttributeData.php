<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeData
{
    public static function of(string $attributeCode, string $frontendInput, string $adminLabel): self
    {
        $attribute = new self($attributeCode, $frontendInput);
        $attribute->frontendLabels = [
            [
                'store_id' => 0,
                'label' => $adminLabel,
            ],
        ];
        $attribute->defaultFrontendLabel = $adminLabel;
        return $attribute;
    }

    public function getCode(): string
    {
        return $this->attributeCode;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function withIsRequired(bool $isRequired): self
    {
        $result = clone $this;
        $result->isRequired = $isRequired;
        return $result;
    }

    public function getFrontendInput(): string
    {
        return $this->frontendInput;
    }

    public function withFrontendInput(string $frontendInput): self
    {
        FrontendInput::validateFrontendInput($frontendInput);
        $result = clone $this;
        $result->frontendInput = $frontendInput;
        return $result;
    }

    public function getFrontendLabels(): array
    {
        return $this->frontendLabels;
    }

    public function getDefaultFrontendLabel()
    {
        return $this->defaultFrontendLabel;
    }

    public function toJson(): array
    {
        return [
            'attribute_code' => $this->attributeCode,
            'is_required' => $this->isRequired,
            'frontend_input' => $this->frontendInput,
            'frontend_labels' => $this->frontendLabels,
            'default_frontend_label' => $this->defaultFrontendLabel,
        ];
    }

    public function equals($attribute): bool
    {
        return $attribute instanceof AttributeData &&
        ($this->attributeCode === $attribute->attributeCode) &&
        ($this->isRequired === $attribute->isRequired) &&
        ($this->frontendInput === $attribute->frontendInput) &&
        ($this->frontendLabels == $attribute->frontendLabels) &&
        ($this->defaultFrontendLabel === $attribute->defaultFrontendLabel);
    }

    private $attributeCode;
    private $isRequired = false;
    private $frontendInput;
    private $frontendLabels = [];
    private $defaultFrontendLabel;

    private function __construct(string $attributeCode, string $frontendInput)
    {
        FrontendInput::validateFrontendInput($frontendInput);
        $this->attributeCode = $attributeCode;
        $this->frontendInput = $frontendInput;
    }
}
