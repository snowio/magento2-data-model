<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class SimpleExtensionAttribute extends ExtensionAttribute
{
    public function getValue()
    {
        return $this->value;
    }

    private $value;

    protected function __construct(string $code, $value)
    {
        parent::__construct($code);
        $this->value = $value;
    }

    public function equals($extensionAttribute): bool
    {
        return parent::equals($extensionAttribute) &&
            ($this->value === $extensionAttribute->value);
    }

    protected function getValueJson()
    {
        return $this->value;
    }
}
