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
            ->withQuantity($quantity);
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

    public function isInStock(): ?bool
    {
        return $this->isInStock;
    }

    public function withInStock(bool $isInStock): self
    {
        $result = clone $this;
        $result->isInStock = $isInStock;
        return $result;
    }

    public function getManageStock(): ?bool
    {
        return $this->manageStock;
    }

    public function withManageStock(bool $manageStock): self
    {
        $result = clone $this;
        $result->manageStock = $manageStock;
        return $result;
    }

    public function getUseConfigManageStock(): ?bool
    {
        return $this->useConfigManageStock;
    }

    public function withUseConfigManageStock(bool $useConfigManageStock): self
    {
        $result = clone $this;
        $result->useConfigManageStock = $useConfigManageStock;
        return $result;
    }

    public function withUseConfigBackorders(bool $useConfigBackorders): self
    {
        $result = clone $this;
        $result->useConfigBackorders = $useConfigBackorders;
        return $result;
    }

    public function getUseConfigBackorders(): bool
    {
        return $this->useConfigBackorders;
    }

    public function equals($other): bool
    {
        return ($other instanceof StockItem) &&
            ($this->stockId === $other->stockId) &&
            ($this->quantity === $other->quantity) &&
            ($this->isInStock === $other->isInStock) &&
            ($this->manageStock === $other->manageStock) &&
            ($this->useConfigBackorders === $other->useConfigBackorders) &&
            ($this->useConfigManageStock === $other->useConfigManageStock);
    }

    public static function fromJson(array $json)
    {
        $json = $json[self::CODE];
        $stockItem = self::create()
            ->withStockId($json['stock_id'])
            ->withQuantity($json['qty']);
        if (isset($json['is_in_stock'])) {
            $stockItem = $stockItem->withInStock($json['is_in_stock']);
        }
        if (isset($json['manage_stock'])) {
            $stockItem = $stockItem->withManageStock($json['manage_stock']);
        }
        if (isset($json['use_config_manage_stock'])) {
            $stockItem = $stockItem->withUseConfigManageStock($json['use_config_manage_stock']);
        }
        return $stockItem;
    }

    public function toJson(): array
    {
        $json = [
            'stock_id' => $this->stockId,
            'qty' => $this->quantity,
        ];
        if (isset($this->isInStock)) {
            $json['is_in_stock'] = $this->isInStock;
        }
        if (isset($this->manageStock)) {
            $json['manage_stock'] = $this->manageStock;
        }
        if (isset($this->useConfigManageStock)) {
            $json['use_config_manage_stock'] = $this->useConfigManageStock;
        }
        if (isset($this->useConfigBackorders)) {
            $json['use_config_backorders'] = $this->useConfigBackorders;
        }
        return $json;
    }

    public function asExtensionAttribute(): ExtensionAttribute
    {
        return ExtensionAttribute::of(self::CODE, $this->toJson());
    }

    private $stockId;
    private $quantity;
    private $isInStock;
    private $manageStock;
    private $useConfigBackorders;
    private $useConfigManageStock;

    protected function __construct()
    {

    }
}
