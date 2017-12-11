<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\AttributeSet;

use SnowIO\Magento2DataModel\ValueObject;

final class AttributeData implements ValueObject
{
    public static function of(string $code): self
    {
        $attributeData = new self;
        $attributeData->code = $code;
        return $attributeData;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function withSortOrder(int $sortOrder): self
    {
        $attributeData = clone $this;
        $attributeData->sortOrder = $sortOrder;
        return $attributeData;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function toJson(): array
    {
        return [
            'attribute_code' => $this->code,
            'sort_order' => $this->sortOrder,
        ];
    }

    public function equals($object): bool
    {
        return $object instanceof AttributeData &&
        $object->code === $this->code &&
        $object->sortOrder === $this->sortOrder;
    }

    private $code;
    private $sortOrder = 1;

    private function __construct()
    {

    }
}
