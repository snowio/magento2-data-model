<?php
namespace SnowIO\Magento2DataModel;

class ProductData
{
    const DEFAULT_ATTRIBUTE_SET_CODE = 'default';
    private const ATTRIBUTE_SET_CODE = 'attribute_set_code';

    public static function of(string $sku): self
    {
        $productData = new self($sku);
        return $productData;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function withStatus(int $status): self
    {

    }

    public function getVisibility(): int
    {
        return $this->visibility;
    }

    public function withVisibility(int $visibility): self
    {
        ProductVisibility::validateVisibility($visibility);
        $result = clone $this;
        $result->visibility = $visibility;
        return $result;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function withPrice(string $price): self
    {

    }

    public function getTypeId(): string
    {
        return $this->typeId;
    }

    public function withTypeId(int $typeId): self
    {

    }

    public function getAttributeSetCode(): string
    {
        return $this->extensionAttributes[self::ATTRIBUTE_SET_CODE];
    }

    public function withAttributeSetCode(string $attributeSetCode): self
    {

    }

    public function toJson(): array
    {
        $json = [];
        $json['sku'] = $this->sku;
        $json['status'] = (int)$this->status;
        $json['visibility'] = (int)$this->visibility;
        $json['price'] = $this->price;
        $json['type_id'] = $this->typeId;
        $json['extension_attributes'] = $this->extensionAttributes;
        return $json;
    }

    private $sku;
    private $status = ProductStatus::ENABLED;
    private $visibility = ProductVisibility::CATALOG_SEARCH;
    private $price;
    private $typeId = ProductTypeId::SIMPLE;
    private $extensionAttributes = [
        self::ATTRIBUTE_SET_CODE => self::DEFAULT_ATTRIBUTE_SET_CODE,
    ];

    private function __construct($sku)
    {
        $this->sku = $sku;
    }
}
