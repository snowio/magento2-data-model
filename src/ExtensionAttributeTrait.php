<?php
namespace SnowIO\Magento2DataModel;

trait ExtensionAttributeTrait
{
    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withExtensionAttribute(ExtensionAttribute $extensionAttribute): self
    {
        $result = clone $this;
        $result->extensionAttributes = $result->extensionAttributes
            ->withExtensionAttribute($extensionAttribute);
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    /** @var ExtensionAttributeSet */
    private $extensionAttributes;
}