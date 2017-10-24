<?php
namespace SnowIO\Magento2DataModel;

class ProductData
{

    const ENABLED = 1;
    const CATALOG_SEARCH = 4;
    const SIMPLE_PRODUCT = 'simple';
    const DEFAULT_ATTRIBUTE_SET = 'default';

    public static function of(string $sku): self
    {
        $productData = new self($sku);
        $productData->status = self::ENABLED;
        $productData->visibility = self::CATALOG_SEARCH;
        $productData->typeId = self::SIMPLE_PRODUCT;
        $productData->extensionAttributes['attribute_set_code'] = self::DEFAULT_ATTRIBUTE_SET;
        return $productData;
    }

    public function toJson(): array
    {
        $json = [];
        $json['sku'] = $this->sku;
        $json['status'] = $this->status;
        $json['visibility'] = $this->visibility;
        $json['type_id'] = $this->typeId;
        $json['extension_attributes'] = $this->extensionAttributes;
        return $json;
    }

    private $sku;
    private $status;
    private $visibility;
    private $typeId;
    private $extensionAttributes = [];

    private function __construct($sku)
    {
        $this->sku = $sku;
    }
}
