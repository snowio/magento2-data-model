<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeData
{
    public static function of(string $attributeCode, string $frontendInput, string $defaultFrontendLabel): self
    {
        $attribute = new self($attributeCode, $frontendInput);
        $attribute->defaultFrontendLabel = $defaultFrontendLabel;
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

    public function withRequired(bool $isRequired): self
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
        $result = clone $this;
        $result->frontendInput = $frontendInput;
        return $result;
    }

    public function getDefaultFrontendLabel()
    {
        return $this->defaultFrontendLabel;
    }

    public function withDefaultFrontendLabel(string $defaultFrontendLabel): self
    {
        $result = clone $this;
        $result->defaultFrontendLabel = $defaultFrontendLabel;
        return $result;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function withScope(string $scope): self
    {
        AttributeScope::validateScope($scope);
        $result = clone $this;
        $result->scope = $scope;
        return $result;
    }


    public function toJson(): array
    {
        return [
            'attribute_code' => $this->attributeCode,
            'is_required' => $this->isRequired,
            'frontend_input' => $this->frontendInput,
            'default_frontend_label' => $this->defaultFrontendLabel,
        ];
    }

    public function equals($attribute): bool
    {
        return $attribute instanceof AttributeData &&
            ($this->attributeCode === $attribute->attributeCode) &&
            ($this->isRequired === $attribute->isRequired) &&
            ($this->frontendInput === $attribute->frontendInput) &&
            ($this->defaultFrontendLabel === $attribute->defaultFrontendLabel) &&
            ($this->scope === $attribute->scope);
    }

    private $attributeCode;
    private $isRequired = false;
    private $frontendInput;
    private $defaultFrontendLabel;
    private $scope;

    private function __construct(string $attributeCode, string $frontendInput)
    {
        $this->attributeCode = $attributeCode;
        $this->frontendInput = $frontendInput;
    }
}
