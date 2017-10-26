<?php
namespace SnowIO\Magento2DataModel;

class ProductData
{
    const DEFAULT_ATTRIBUTE_SET_CODE = 'default';
    private const ATTRIBUTE_SET_CODE = 'attribute_set_code';

    public static function of(string $sku, string $name): self
    {
        $productData = new self($sku);
        $productData->customAttributes = CustomAttributeSet::create();
        return $productData;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {

    }

    public function withName(string $name): self
    {

    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function withStatus(int $status): self
    {
        ProductStatus::validateStatus($status);
        $result = clone $this;
        $result->status = $status;
        return $result;
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
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    public function getTypeId(): string
    {
        return $this->typeId;
    }

    public function withTypeId(string $typeId): self
    {
        ProductTypeId::validateTypeId($typeId);
        $result = clone $this;
        $result->typeId = $typeId;
        return $result;
    }

    public function getAttributeSetCode(): string
    {
        return $this->extensionAttributes[self::ATTRIBUTE_SET_CODE];
    }

    public function withAttributeSetCode(string $attributeSetCode): self
    {
        $result = clone $this;
        $result->extensionAttributes[self::ATTRIBUTE_SET_CODE] =  $attributeSetCode;
        return $result;
    }

    public function getCustomAttributes(): CustomAttributeSet
    {
        return $this->customAttributes;
    }

    public function withCustomAttribute(CustomAttribute $customAttribute)
    {
        $result = clone $this;
        $result->customAttributes = $result->customAttributes
            ->withCustomAttribute($customAttribute);
        return $result;
    }

    public function withCustomAttributes(CustomAttributeSet $customAttributes): self
    {
        $result = clone $this;
        $result->customAttributes = $result->customAttributes
            ->add($customAttributes);
        return $result;
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
        $json['custom_attributes'] = $this->customAttributes->toJson();
        return $json;
    }

    public function equals($otherProductData): bool
    {
        return $otherProductData instanceof ProductData &&
        ($this->sku === $otherProductData->sku) &&
        ($this->status === $otherProductData->status) &&
        ($this->visibility === $otherProductData->visibility) &&
        ($this->price === $otherProductData->price) &&
        ($this->typeId === $otherProductData->typeId) &&
        ($this->extensionAttributes == $otherProductData->extensionAttributes) &&
        $this->customAttributes->equals($otherProductData->customAttributes);
    }

    private $sku;
    private $status = ProductStatus::ENABLED;
    private $visibility = ProductVisibility::CATALOG_SEARCH;
    private $price;
    private $typeId = ProductTypeId::SIMPLE;
    private $extensionAttributes = [
        self::ATTRIBUTE_SET_CODE => self::DEFAULT_ATTRIBUTE_SET_CODE,
    ];
    /** @var CustomAttributeSet */
    private $customAttributes;

    private function __construct($sku)
    {
        $this->sku = $sku;
    }
}
