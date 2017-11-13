<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CustomAttribute
{
    public static function of(string $attributeCode, ?string $value): self
    {
        $customAttribute = new self;
        $customAttribute->attributeCode = $attributeCode;
        $customAttribute->value = $value;
        return $customAttribute;
    }

    public function getCode(): string
    {
        return $this->attributeCode;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function equals($customAttribute): bool
    {
        return $customAttribute instanceof CustomAttribute &&
        ($this->attributeCode === $customAttribute->attributeCode)
        && ($this->value === $customAttribute->value);
    }

    public function toJson(): array
    {
        $json = [];
        $json['attribute_code'] = $this->attributeCode;
        $json['value'] = $this->value;
        return $json;
    }

    private $attributeCode;
    private $value;

    private function __construct()
    {
    }
}
