<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

class AttributeOptionStoreLabel implements ValueObject
{
    public static function of(string $storeCode, string $label)
    {
        return new self($storeCode, $label);
    }

    public function getStoreCode()
    {
        return $this->storeCode;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function toJson()
    {
        return [
            'store_code' => $this->storeCode,
            'label' => $this->label
        ];
    }

    private $label;
    private $storeCode;

    private function __construct(string $storeCode, string $label)
    {
        $this->label = $label;
        $this->storeCode = $storeCode;
    }

    public function equals($object): bool
    {
        return $object instanceof self &&
            $object->label == $this->label &&
            $object->storeCode == $this->storeCode;
    }
}
