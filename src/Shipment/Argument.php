<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Argument implements ValueObject
{
    /** @var ExtensionAttributeSet */
    private $extensionAttributes;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    /**
     * @return ExtensionAttributeSet
     */
    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    /**
     * @param ExtensionAttributeSet $extensionAttributes
     * @return Argument
     */
    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): Argument
    {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
        return $clone;
    }
    
    public function isEmpty()
    {
        return $this->extensionAttributes->isEmpty();
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }
    
    public function toJson() : array
    {
        return ['extension_attributes' => $this->extensionAttributes->toJson()];
    }

    public function equals($other): bool
    {
        return $other instanceof self && $this->extensionAttributes->equals($other->extensionAttributes);
    }

    protected function __construct()
    {
    }
}
