<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductCategoryAssociation
{
    public static function of(string $productSku, array $categoryCodes): self
    {
        return new self($productSku, $categoryCodes);
    }

    public function getProductSku(): string
    {
        return $this->productSku;
    }

    public function getCategoryCodes(): array
    {
        return $this->categoryCodes;
    }

    public function withCategoryCode(string $categoryCode): self
    {
        $result = clone $this;
        $result->categoryCodes[] = $categoryCode;
        return $result;
    }


    public function withCategoryCodes(array $categoryCodes): self
    {
        $result = clone $this;
        $result->categoryCodes = $categoryCodes;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'productSku' => $this->productSku,
            'categoryCodes' => $this->categoryCodes
        ];
    }

    public function equals($otherProductCategoryAssociation): bool
    {
        return $otherProductCategoryAssociation instanceof ProductCategoryAssociation &&
        ($otherProductCategoryAssociation->productSku === $this->productSku) &&
        ($otherProductCategoryAssociation->categoryCodes === $this->categoryCodes);
    }

    private $productSku;
    private $categoryCodes;

    private function __construct(string $productSku, array $categoryCodes)
    {
        $this->productSku = $productSku;
        $this->categoryCodes = $categoryCodes;
    }
}