<?php
namespace SnowIO\Magento2DataModel;

final class ProductLinkAssociation implements ValueObject
{
    public static function of(ProductLink $productLink): self
    {
        $productLinkAssociation = new self;
        $productLinkAssociation->productLink = $productLink;
        return $productLinkAssociation;
    }

    public function getProductSku(): string
    {
        return $this->productLink->getSku();
    }

    public function getLinkType(): string
    {
        return $this->productLink->getLinkType();
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->productLink->equals($object->productLink);
    }

    public function toJson(): array
    {
        return [
            'sku' => $this->productLink->getSku(),
            'entity' => $this->productLink->toJson(),
        ];
    }

    /** @var ProductLink */
    private $productLink;

    private function __construct()
    {
    }
}
