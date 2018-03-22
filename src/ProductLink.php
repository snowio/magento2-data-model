<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class ProductLink implements ValueObject
{
    const EXTENSION_QUANTITY = 'qty';
    const PRODUCT_TYPE_SIMPLE = 'simple';
    const LINK_TYPE_ASSOCIATED = 'associated';

    private $sku;
    private $linkType;
    private $linkedProductSku;
    private $linkedProductType;
    private $position;

    /** @var $extensionAttributes ExtensionAttributeSet */
    private $extensionAttributes;

    public static function of(string $sku, string $linkedProductSku, string $linkType): self
    {
        $result = new self($sku, $linkedProductSku, $linkType);
        $result->extensionAttributes = ExtensionAttributeSet::create();
        return $result;
    }

    public function withQty(int $qty): self
    {
        $result = clone $this;
        $result->extensionAttributes = ExtensionAttributeSet::create()
            ->withExtensionAttribute(
                ExtensionAttribute::of(self::EXTENSION_QUANTITY, $qty)
            );
        return $result;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getLinkType(): ?string
    {
        return $this->linkType;
    }

    public function getLinkedProductType(): ?string
    {
        return $this->linkedProductType;
    }

    public function getLinkedProductSku(): ?string
    {
        return $this->linkedProductSku;
    }

    private function getPosition(): int
    {
        return (int) $this->position;
    }

    public function withLinkType(string $linkType): self
    {
        $result = clone $this;
        $result->linkType = $linkType;
        return $result;
    }

    public function withLinkedProductSku(string $linkedProductSku): self
    {
        $result = clone $this;
        $result->linkedProductSku = $linkedProductSku;
        return $result;
    }

    public function withLinkedProductType(string $linkedProductType): self
    {
        $result = clone $this;
        $result->linkedProductType = $linkedProductType;
        return $result;
    }

    public function withPosition(int $position): self
    {
        $result = clone $this;
        $result->position = $position;
        return $result;
    }

    public function equals($object): bool
    {
        return ($object instanceof ProductLink) &&
        ($this->sku === $object->sku) &&
        ($this->linkType === $object->linkType) &&
        ($this->linkedProductSku === $object->linkedProductSku) &&
        ($this->linkedProductType === $object->linkedProductType) &&
        ($this->position === $object->position);
    }

    public function fromJson($json): TierPrice
    {
        return self::create()
            ->withCustomerGroupId($json['customer_group_id'])
            ->withQty($json[self::EXTENSION_QUANTITY])
            ->withValue($json['value']);
    }

    public function toJson(): array
    {
        return [
            'sku' => $this->getSku(),
            'link_type' => $this->getLinkType(),
            'linked_product_sku' => $this->getLinkedProductSku(),
            'linked_product_type' => $this->getLinkedProductType(),
            'position' => $this->getPosition(),
            'extension_attributes' => $this->extensionAttributes->toJson()
        ];
    }

    private function __construct(string $sku, string $linkedProductSku, string $linkType)
    {
        $this->sku = $sku;
        $this->linkedProductSku = $linkedProductSku;
        $this->linkType = $linkType;
        $this->linkedProductType = self::PRODUCT_TYPE_SIMPLE;
    }

}
