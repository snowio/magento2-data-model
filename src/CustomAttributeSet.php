<?php
namespace SnowIO\Magento2DataModel;

class CustomAttributeSet implements \IteratorAggregate
{
    public static function of(array $customAttributes): self
    {
        return new self($customAttributes);
    }

    private $customAttributes;

    private function __construct($customAttributes)
    {
        $this->customAttributes = $customAttributes;
    }

    public function getIterator()
    {
        foreach ($this->customAttributes as $customAttribute) {
            yield $customAttribute;
        }
    }
}