<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use SnowIO\Magento2DataModel\ExtensionAttribute;

final class StockItem extends ExtensionAttribute
{

    public static function of(int $internalAmount, int $warehouseAmount)
    {
        $stock = new self($internalAmount, $warehouseAmount);
        $stock->internalAmount = $internalAmount;
        $stock->warehouseAmount = $warehouseAmount;
        return $stock;
    }

    public function equals($value): bool
    {
        return $value instanceof self &&
        ($this->internalAmount === $value->internalAmount) &&
        ($this->warehouseAmount === $value->warehouseAmount);
    }

    protected function getValueJson()
    {
        return [
            'internal_amount' => $this->internalAmount,
            'warehouse_amount' => $this->warehouseAmount,
        ];
    }

    private $internalAmount;
    private $warehouseAmount;

    protected function __construct($internalAmount, $warehouseAmount)
    {
        parent::__construct('stock');
        $this->internalAmount = $internalAmount;
        $this->warehouseAmount = $warehouseAmount;
    }
}
