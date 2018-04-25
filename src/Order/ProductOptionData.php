<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class ProductOptionData implements ValueObject
{
    public static function create(): self
    {
        return new self;
    }

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes']);
        return $result;
    }

    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'extension_attributes' => $this->extensionAttributes->toJson(),
        ];
    }

    private $extensionAttributes;

    private function __construct()
    {
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }

    public function equals($object): bool
    {
        return $object instanceof self && $this->extensionAttributes->equals($object->extensionAttributes);
    }
}
