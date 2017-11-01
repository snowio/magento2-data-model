<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductData
{
    use EavEntityTrait;

    const DEFAULT_ATTRIBUTE_SET_CODE = 'default';
    private const ATTRIBUTE_SET_CODE = 'attribute_set_code';

    public static function of(string $sku, string $name): self
    {
        $productData = new self($sku, $name);
        $productData->customAttributes = CustomAttributeSet::create();
        $productData->extensionAttributes = ExtensionAttributeSet::create()
            ->withExtensionAttribute(
                ExtensionAttribute::of(self::ATTRIBUTE_SET_CODE, self::DEFAULT_ATTRIBUTE_SET_CODE)
            );
        return $productData;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
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
        return $this->extensionAttributes->get(self::ATTRIBUTE_SET_CODE)->getValue();
    }

    public function withAttributeSetCode(string $attributeSetCode): self
    {
        $result = clone $this;
        $result->extensionAttributes = $result->extensionAttributes
            ->withExtensionAttribute(
                ExtensionAttribute::of(self::ATTRIBUTE_SET_CODE, $attributeSetCode)
            );
        return $result;
    }

    public function toJson(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'status' => (int)$this->status,
            'visibility' => (int)$this->visibility,
            'price' => $this->price,
            'type_id' => $this->typeId,
            'extension_attributes' => $this->extensionAttributes->toJson(),
            'custom_attributes' => $this->customAttributes->toJson(),
        ];
    }

    public function equals($otherProductData): bool
    {
        return $otherProductData instanceof ProductData &&
        ($this->sku === $otherProductData->sku) &&
        ($this->name === $otherProductData->name) &&
        ($this->status === $otherProductData->status) &&
        ($this->visibility === $otherProductData->visibility) &&
        ($this->price === $otherProductData->price) &&
        ($this->typeId === $otherProductData->typeId) &&
        ($this->extensionAttributes->equals($otherProductData->extensionAttributes)) &&
        $this->customAttributes->equals($otherProductData->customAttributes);
    }

    private $sku;
    private $name;
    private $status = ProductStatus::ENABLED;
    private $visibility = ProductVisibility::CATALOG_SEARCH;
    private $price;
    private $typeId = ProductTypeId::SIMPLE;

    private function __construct(string $sku, string $name)
    {
        $this->sku = $sku;
        $this->name = $name;
    }
}
