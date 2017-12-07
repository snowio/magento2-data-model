<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

final class DeleteAttributeCommand extends Command
{
    public static function of(string $attributeCode): self
    {
        $result = new self;
        $result->attributeCode = $attributeCode;
        return $result;
    }

    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'attributeCode' => $this->attributeCode,
        ];
    }

    private $attributeCode;

    private function __construct()
    {

    }
}
