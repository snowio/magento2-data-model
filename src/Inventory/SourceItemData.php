<?php
namespace SnowIO\Magento2DataModel\Inventory;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ExtensionAttributeTrait;

class SourceItemData
{
    use ExtensionAttributeTrait;

    public static function of(string $sku, string $sourceCode): self
    {
        $result = new self;
        $result->sku = $sku;
        $result->sourceCode = $sourceCode;
        return $result;
    }

    public function withSku($sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    public function withSourceCode($sourceCode): self
    {
        $result = clone $this;
        $result->sourceCode = $sourceCode;
        return $result;
    }

    public function withQuantity($quantity): self
    {
        $result = clone $this;
        $result->quantity = $quantity;
        return $result;
    }

    public function withStatus($status): self
    {
        $result = clone $this;
        $result->status = $status;
        return $result;
    }

    public function toJson()
    {
        return [
            'sku' => $this->sku,
            'source_code' => $this->sourceCode,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'extension_attributes' => $this->extensionAttributes->toJson(),
        ];
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getSourceCode()
    {
        return $this->sourceCode;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getStatus()
    {
        return $this->status;
    }

    private $sku;
    private $sourceCode;
    private $quantity;
    private $status;

    public function equals($other) : bool
    {
        return $other instanceof self &&
            $this->sku === $other->sku &&
            $this->sourceCode === $other->sourceCode &&
            $this->quantity === $other->quantity &&
            $this->status === $other->status;
    }

    private function __construct()
    {
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }
}
