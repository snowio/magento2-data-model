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

    /**
     * @param string $storeId
     * @param string $price
     * @param string $sku
     * @param string $priceFrom
     * @param string $priceTo
     * @return SpecialPrice
     */
    public static function of(string $storeId, string $price, string $sku, string $priceFrom, string $priceTo): SpecialPrice
    {
        $specialPrice = new self($storeId, $price, $sku, $priceFrom, $priceTo);
        return $specialPrice;
    }

    /**
     * SpecialPrice constructor.
     * @param string $storeId
     * @param string $price
     * @param string $sku
     * @param string $priceFrom
     * @param string $priceTo
     */
    private function __construct(string $storeId, string $price, string $sku, string $priceFrom, string $priceTo)
    {
        $this->storeId = $storeId;
        $this->price = $price;
        $this->sku = $sku;
        $this->priceFrom = $priceFrom;
        $this->priceTo = $priceTo;
    }

    /**
     * @param $object
     * @return bool
     */
    public function equals($object): bool
    {
        return ($object instanceof SpecialPrice) &&
            ($this->storeId === $object->storeId) &&
            ($this->price === $object->price) &&
            ($this->sku === $object->sku);
    }

    /**
     * @return array
     */
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

    /**
     * @return ExtensionAttribute
     */
    public function asExtensionAttribute(): ExtensionAttribute
    {
        return ExtensionAttribute::of(self::CODE, $this->toJson());
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return SpecialPrice
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
     * @return SpecialPrice
     */
    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    /**
     * @author Liam Toohey (lt@amp.co)
     * @return string
     */
    public function getStoreId(): string
    {
        return $this->storeId;
    }

    /**
     * @param string $storeId
     * @return SpecialPrice
     */
    public function withStoreId(string $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    /**
     * @return string
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * @param $priceFrom
     * @return SpecialPrice
     */
    public function withPriceFrom($priceFrom): self
    {
        $result = clone $this;
        $result->priceFrom = $priceFrom;
        return $result;
    }

    /**
     * @return string
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * @param $priceTo
     * @return SpecialPrice
     */
    public function withPriceTo($priceTo): self
    {
        $result = clone $this;
        $result->priceTo = $priceTo;
        return $result;
    }
}
