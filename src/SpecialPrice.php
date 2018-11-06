<?php
namespace SnowIO\Magento2DataModel;

final class SpecialPrice implements ValueObject
{
    const CODE = 'special_price';

    private $storeId;
    private $price;
    private $sku;
    private $priceFrom;
    private $priceTo;

    public static function of(string $storeId, string $price, string $sku, string $priceFrom, string $priceTo)
    {
        $specialPrice = new self($storeId, $price, $sku, $priceFrom, $priceTo);
        return $specialPrice;
    }

    private function __construct(string $storeId, string $price, string $sku, string $priceFrom, string $priceTo)
    {
        $this->storeId = $storeId;
        $this->price = $price;
        $this->sku = $sku;
        $this->priceFrom = $priceFrom;
        $this->priceTo = $priceTo;
    }

    public function equals($object): bool
    {
        return ($object instanceof SpecialPrice) &&
            ($this->storeId === $object->storeId) &&
            ($this->price === $object->price) &&
            ($this->sku === $object->sku);
    }

    public function toJson(): array
    {
        return [
            "store_id" => $this->getStoreId(),
            "price" => $this->getPrice(),
            "sku" => $this->getSku(),
            "price_from" => $this->getPriceFrom(),
            "price_to" => $this->getPriceTo()
        ];
    }

    public function asExtensionAttribute(): ExtensionAttribute
    {
        return ExtensionAttribute::of(self::CODE, $this->toJson());
    }

    /**
     * @return float
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function withPrice(string $price): self
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    /**
     * @return int
     */
    public function getStoreId(): string
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     */
    public function withStoreId(string $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * @param mixed $priceFrom
     */
    public function withPriceFrom($priceFrom): self
    {
        $result = clone $this;
        $result->priceFrom = $priceFrom;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * @param mixed $priceTo
     */
    public function withPriceTo($priceTo): self
    {
        $result = clone $this;
        $result->priceTo = $priceTo;
        return $result;
    }
}
