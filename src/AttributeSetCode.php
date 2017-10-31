<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class AttributeSetCode extends ExtensionAttribute
{
    public static function of(string $value): self
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals($attributeSetCode): bool
    {
        return parent::equals($attributeSetCode) &&
            ($attributeSetCode->value === $this->value);
    }

    protected function getValueJson()
    {
        return $this->value;
    }

    private $value;

    protected function __construct(string $value)
    {
        parent::__construct('attribute_set_code');
        $this->value = $value;
    }
}
