<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

final class DeleteAttributeOptionCommand extends Command
{
    public static function of(string $attributeCode, string $optionCode): self
    {
        $deleteAttributeOptionCommand = new self;
        $deleteAttributeOptionCommand->attributeCode = $attributeCode;
        $deleteAttributeOptionCommand->optionCode = $optionCode;
        return $deleteAttributeOptionCommand;
    }

    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    public function getOptionCode(): string
    {
        return $this->optionCode;
    }

    public function getEntityType(): int
    {
        return $this->entityType;
    }

    public function withEntityType(int $entityType): self
    {
        $result = clone $this;
        $result->entityType = $entityType;
        return $result;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->entityType === $object->entityType
            && $this->attributeCode === $object->attributeCode
            && $this->optionCode === $object->optionCode
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'entityType' => $this->entityType,
            'attributeCode' => $this->attributeCode,
            'optionCode' => $this->optionCode,
        ];
    }

    private const PRODUCT = 4;

    private $attributeCode;
    private $optionCode;
    private $entityType = self::PRODUCT;

    private function __construct()
    {

    }
}
