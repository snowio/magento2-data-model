<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

final class FamilyAttributeData
{
    public static function of(string $code, int $sortOrder): self
    {
        $familyAttributeData = new self;
        $familyAttributeData->code = $code;
        $familyAttributeData->sortOrder = $sortOrder;
        return $familyAttributeData;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function withSortOrder(int $sortOrder): self
    {
        $familyAttributeData = clone $this;
        $familyAttributeData->sortOrder = $sortOrder;
        return $familyAttributeData;
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

    public function equals($otherFamilyAttributeData): bool
    {
        return $otherFamilyAttributeData instanceof FamilyAttributeData &&
        $otherFamilyAttributeData->code === $this->code &&
        $otherFamilyAttributeData->sortOrder === $this->sortOrder;
    }

    private $code;
    private $sortOrder;

    private function __construct()
    {

    }
}