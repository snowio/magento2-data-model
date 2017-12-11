<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\AttributeData;

final class SaveAttributeCommand extends Command
{
    public static function of(AttributeData $attributeData): self
    {
        $command = new self;
        $command->attributeData = $attributeData;
        return $command;
    }

    public function getAttributeData(): AttributeData
    {
        return $this->attributeData;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->attributeData->equals($object->attributeData)
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'attribute' => $this->attributeData->toJson(),
        ];
    }

    /** @var AttributeData */
    private $attributeData;

    private function __construct()
    {

    }
}
