<?php
namespace SnowIO\Magento2DataModel;

class CustomAttributeSet implements \IteratorAggregate
{
    public static function of(array $customAttributes): self
    {

    }

    private static function getKey(CustomAttribute $customAttribute): self
    {

    }

    private $items;

    private function __construct($customAttributes)
    {
        $this->items = $customAttributes;
    }
}