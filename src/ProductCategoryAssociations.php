<?php
namespace SnowIO\Magento2DataModel;

final class ProductCategoryAssociations implements ValueObject
{
    public static function of(string $productSku, CategoryCodeSet $categoryCodes): self
    {
        $productCategoryAssociations = new self;
        $productCategoryAssociations->productSku = $productSku;
        $productCategoryAssociations->categoryCodes = $categoryCodes;
        return $productCategoryAssociations;
    }

    public function getProductSku(): string
    {
        return $this->productSku;
    }

    public function getCategoryCodes(): CategoryCodeSet
    {
        return $this->categoryCodes;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->productSku === $object->productSku
            && $this->categoryCodes->equals($object->categoryCodes);
    }

    public function toJson(): array
    {
        return [
            'productSku' => $this->productSku,
            'categoryCodes' => $this->categoryCodes->toArray(),
        ];
    }

    private $productSku;
    /** @var CategoryCodeSet */
    private $categoryCodes;

    private function __construct()
    {

    }
}
