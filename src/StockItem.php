<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class StockItem implements ValueObject
{
    const CODE = 'stock_item';

    public static function create()
    {
        return new self;
    }

    public static function of(int $stockId, int $quantity)
    {
        return self::create()
            ->withStockId($stockId)
            ->withQuantity($quantity)
            ->withInStock(0 < $quantity);
    }

    public static function fromJson(array $json)
    {
        $json = $json[self::CODE];
        $stockId = $json['stock_id'];
        $quantity = $json['qty'];
        return self::create()
            ->withStockId($stockId)
            ->withQuantity($quantity)
            ->withInStock($quantity > 0);
    }

    public function getStockId(): int
    {
        return $this->stockId;
    }

    public function withStockId(int $stockId): self
    {
        $result = clone $this;
        $result->stockId = $stockId;
        return $result;
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
        return ($extensionAttribute instanceof StockItem) &&
            ($this->stockId === $extensionAttribute->stockId) &&
            ($this->quantity === $extensionAttribute->quantity) &&
            ($this->isInStock === $extensionAttribute->isInStock);
    }

    public function toJson(): array
    {
        return [
            'stock_id' => $this->stockId,
            'qty' => $this->quantity,
            'is_in_stock' => $this->isInStock,
        ];
    }

    public function asExtensionAttribute(): ExtensionAttribute
    {
        return ExtensionAttribute::of(self::CODE, $this->toJson());
    }

    private $isInStock;
    private $quantity;
    private $stockId;

    protected function __construct()
    {

    }
}
