<?php
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\AttributeSetData;

class SaveAttributeSetCommand extends Command
{
    public static function of(AttributeSetData $attributeSetData): self
    {
        $command = new self;
        $command->attributeSetData = $attributeSetData;
        return $command
            ->withCommandGroupId("attribute_set.{$attributeSetData->getEntityTypeCode()}.{$attributeSetData->getCode()}")
            ->withShardingKey($attributeSetData->getCode());
    }

    public function getAttributeSetData(): AttributeSetData
    {
        return $this->attributeSetData;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->attributeSetData->equals($object->attributeSetData)
            && parent::equals($object);
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
