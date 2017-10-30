<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

class ExtensionAttribute
{
    public static function of(string $key, ExtensionAttributeValue $value)
    {
        return new self($key, $value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): ExtensionAttributeValue
    {
        return $this->value;
    }

    public function toJson(): array
    {
        return [
            $this->key => $this->value->toJson(),
        ];
    }

    public function equals($extensionAttribute): bool
    {
        return $extensionAttribute instanceof ExtensionAttribute &&
            ($this->key === $extensionAttribute->key) &&
            ($this->value->equals($extensionAttribute->value));
    }

    private $key;
    /** @var ExtensionAttributeValue */
    private $value;

    private function __construct(string $key, ExtensionAttributeValue $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}
