<?php
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\AttributeSetData;

class SaveAttributeSetCommand extends Command
{
    public static function of(AttributeSetData $attributeSetData): self
    {
        $command = new self;
        $command->attributeSetData = $attributeSetData;
        $commandGroupId = "attribute_set.{$attributeSetData->getEntityTypeCode()}.{$attributeSetData->getCode()}";
        return $command->withCommandGroupId($commandGroupId);
    }

    public function getAttributeSetData(): AttributeSetData
    {
        return $this->attributeSetData;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            '@store' => 'admin',
            'attribute_set' => $this->attributeSetData->toJson()
        ];
    }

    /** @var AttributeSetData */
    private $attributeSetData;

    private function __construct()
    {

    }
}
