<?php
namespace SnowIO\Magento2DataModel;

class CustomAttribute
{
    public static function of(string $attributeCode, string $value): self
    {
        $customAttribute = new self;
        $customAttribute->attributeCode = $attributeCode;
        $customAttribute->value = $value;
        return $customAttribute;
    }

    private $attributeCode;
    private $value;

    public function toJson(): array
    {
        $json = [];
        $json['attribute_code'] = $this->attributeCode;
        $json['value'] = $this->value;
        return $json;
    }

    private function __construct()
    {
    }
}