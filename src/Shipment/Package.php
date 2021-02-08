<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Package implements ValueObject
{
    /** @var ExtensionAttributeSet|null */
    private $extensionAttributes;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->extensionAttributes = isset($json['extension_attributes']) ? 
            ExtensionAttributeSet::fromJson($json['extension_attributes']) :
            null;
        return $result;
    }
    
    public function getExtensionAttributes()
    {
        return $this->extensionAttributes;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }
    
    public function toJson() : array
    {
        return [
            'extension_attributes' => $this->extensionAttributes ? $this->extensionAttributes->toJson() : null
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->extensionAttributes->equals($other->extensionAttributes);
    }

    protected function __construct()
    {
    }
}
