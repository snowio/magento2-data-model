<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class StockItem extends ExtensionAttribute
{
    private const STOCK_ITEM = 'stock_item';

    public static function create(int $stockId, int $quantity)
    {
        return new self($stockId, $quantity);
    }

    public function getStockId(): int
    {
        return $this->stockId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function withQuantity(int $quantity): self
    {
        $result = clone $this;
        $result->quantity = $quantity;
        return $result;
    }

    public function isInStock(): bool
    {
        return $this->isInStock;
    }

    public function withInStock(bool $isInStock): self
    {
        $result = clone $this;
        $result->isInStock = $isInStock;
        return $result;
    }

    public function equals($extensionAttribute): bool
    {
        return parent::equals($extensionAttribute) &&
            ($extensionAttribute instanceof StockItem) &&
            ($this->stockId === $extensionAttribute->stockId) &&
            ($this->quantity === $extensionAttribute->quantity) &&
            ($this->isInStock === $extensionAttribute->isInStock);
    }

    protected function getValueJson(): array
    {
        return [
            'stock_id' => $this->stockId,
            'qty' => $this->quantity,
            'is_in_stock' => $this->isInStock,
        ];
    }

    private $isInStock;
    private $quantity;
    private $stockId;

    protected function __construct(int $stockId, int $quantity)
    {
        parent::__construct(self::STOCK_ITEM);
        $this->stockId = $stockId;
        $this->quantity = $quantity;
        $this->isInStock = $quantity > 0;
    }
}
