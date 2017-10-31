<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use SnowIO\Magento2DataModel\ExtensionAttribute;

class SupplierReference extends ExtensionAttribute {

    public static function of(int $referenceNumber)
    {
        $supplierReference = new self($referenceNumber);
        $supplierReference->referenceNumber = $referenceNumber;
        return $supplierReference;
    }

    public function equals($value): bool
    {
        return $value instanceof self &&
        ($this->referenceNumber === $value->referenceNumber);
    }

    private $referenceNumber;

    protected function __construct($referenceNumber)
    {
        parent::__construct('supplier_reference');
        $this->referenceNumber = $referenceNumber;
    }

    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    protected function getValueJson()
    {
        return $this->referenceNumber;
    }
}
