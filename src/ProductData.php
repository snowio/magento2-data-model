<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductData implements ValueObject
{
    use EavEntityTrait;

    const DEFAULT_ATTRIBUTE_SET_CODE = 'default';
    private const ATTRIBUTE_SET_CODE = 'attribute_set_code';

    public static function of(string $sku, string $name): self
    {
        $productData = new self($sku, $name);
        $productData->customAttributes = CustomAttributeSet::create();
        $productData->tierPrices = TierPriceSet::create();
        $productData->productLinks = ProductLinkSet::create();

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

    public function withWeight(string $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function getAttributeSetCode(): string
    {
        return $this->extensionAttributes->get(self::ATTRIBUTE_SET_CODE)->getValue();
    }

    public function withAttributeSetCode(string $attributeSetCode): self
    {
        $result = clone $this;
        $result->attributeSetId = null;
        $result->extensionAttributes = $result->extensionAttributes
            ->withExtensionAttribute(
                ExtensionAttribute::of(self::ATTRIBUTE_SET_CODE, $attributeSetCode)
            );
        return $result;
    }

    public function withAttributeSetId(int $attributeSetId): self
    {
        $result = clone $this;
        $result->attributeSetId = $attributeSetId;
        $result->extensionAttributes = $result->extensionAttributes->deleteExtensionAttribute(
            ExtensionAttribute::of(self::ATTRIBUTE_SET_CODE, null)
        );
        return $result;
    }

    public function getStockItem(): ?StockItem
    {
        $extensionAttribute = $this->extensionAttributes->get(StockItem::CODE);
        if ($extensionAttribute === null) {
            return null;
        }
        return StockItem::fromJson($extensionAttribute->toJson());
    }

    public function withStockItem(StockItem $stockItem): self
    {
        $result = clone $this;
        $result->extensionAttributes = $this->extensionAttributes
            ->withExtensionAttribute($stockItem->asExtensionAttribute());
        return $result;
    }

    public function withSpecialPriceSet(SpecialPriceSet $specialPriceSet): self
    {
        $result = clone $this;
        $result->extensionAttributes = $this->extensionAttributes
            ->withExtensionAttribute($specialPriceSet->asExtensionAttribute());
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        if (!$extensionAttributes->has(self::ATTRIBUTE_SET_CODE)) {
            $attributeSetCode = $result->extensionAttributes->get(self::ATTRIBUTE_SET_CODE);
            $extensionAttributes = $extensionAttributes->withExtensionAttribute($attributeSetCode);
        }

        if (!$extensionAttributes->has(StockItem::CODE) && $result->extensionAttributes->has(StockItem::CODE)) {
            $stockItem = $result->extensionAttributes->get(StockItem::CODE);
            $extensionAttributes = $extensionAttributes->withExtensionAttribute($stockItem);
        }

        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function getMediaGalleryEntries(): ?MediaGalleryEntrySet
    {
        return $this->mediaGalleryEntries;
    }

    public function withMediaGalleryEntry(MediaGalleryEntry $mediaGalleryEntry): self
    {
        $result = clone $this;
        $result->mediaGalleryEntries->withMediaGalleryEntry($mediaGalleryEntry);
        return $result;
    }

    public function withMediaGalleryEntries(?MediaGalleryEntrySet $mediaGalleryEntries): self
    {
        $result = clone $this;
        $result->mediaGalleryEntries = $mediaGalleryEntries;
        return $result;
    }

    public function withTierPrices(TierPriceSet $tierPrices): self
    {
        $result = clone $this;
        $result->tierPrices = $tierPrices;
        return $result;
    }

    public function getTierPrices(): TierPriceSet
    {
        return $this->tierPrices;
    }

    public function withProductLinks(ProductLinkSet $productLinks): self
    {
        $result = clone $this;
        $result->productLinks = $productLinks;
        return $result;
    }

    public function getProductLinks(): ProductLinkSet
    {
        return $this->productLinks;
    }

    public function toJson(): array
    {
        $json = [
            'sku' => $this->sku,
            'name' => $this->name,
            'status' => (int)$this->status,
            'visibility' => (int)$this->visibility,
            'price' => $this->price,
            'type_id' => $this->typeId,
            'weight' => $this->weight,
            'extension_attributes' => $this->extensionAttributes->toJson(),
            'custom_attributes' => $this->customAttributes->toJson(),
            'tier_prices' => $this->tierPrices->toJson(),
            'product_links' => $this->productLinks->toJson()
        ];

        if ($this->mediaGalleryEntries !== null) {
            $json['media_gallery_entries'] = $this->mediaGalleryEntries->toJson();
        }

        if ($this->attributeSetId !== null) {
            $json['attribute_set_id'] = (int) $this->attributeSetId;
        }
        return $json;
    }

    public function equals($otherProductData): bool
    {
        $equals =  $otherProductData instanceof ProductData &&
        ($this->sku === $otherProductData->sku) &&
        ($this->name === $otherProductData->name) &&
        ($this->status === $otherProductData->status) &&
        ($this->visibility === $otherProductData->visibility) &&
        ($this->price === $otherProductData->price) &&
        ($this->typeId === $otherProductData->typeId) &&
        ($this->weight === $otherProductData->weight) &&
        ($this->extensionAttributes->equals($otherProductData->extensionAttributes)) &&
        $this->customAttributes->equals($otherProductData->customAttributes) &&
        $this->tierPrices->equals($otherProductData->tierPrices) &&
        $this->productLinks->equals($otherProductData->productLinks) &&
        $this->mediaGalleryEntriesAreEqual($otherProductData) &&
        ($this->storeCode === $otherProductData->storeCode);

        return $equals;
    }

    private function mediaGalleryEntriesAreEqual($otherProductData): bool
    {
        if ($this->mediaGalleryEntries === null && $otherProductData->mediaGalleryEntries === null) {
            return true;
        }
        //and one is null but not the other (from above && clause we know they aren't both null)
        if ($this->mediaGalleryEntries === null || $otherProductData->mediaGalleryEntries === null) {
            return false;
        }

        //If both products have an empty items mediaGalleryEntries then they are equal - covered by the equals method
        //If both products have items in mediaGalleryEntries then they could be equal - covered by the equals method
        return $this->mediaGalleryEntries->equals($otherProductData->mediaGalleryEntries);
    }

    private $sku;
    private $name;
    private $status = ProductStatus::ENABLED;
    private $visibility = ProductVisibility::CATALOG_SEARCH;
    private $price;
    private $typeId = ProductTypeId::SIMPLE;
    private $weight;
    private $mediaGalleryEntries;
    private $tierPrices;
    private $productLinks;
    private $attributeSetId;

    private function __construct(string $sku, string $name)
    {
        $this->sku = $sku;
        $this->name = $name;
    }
}
