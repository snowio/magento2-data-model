<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\AttributeOption;

final class SaveAttributeOptionCommand extends Command
{
    public static function of(AttributeOption $attributeOption): self
    {
        $saveAttributeOptionCommand = new self;
        $saveAttributeOptionCommand->attributeOption = $attributeOption;
        return $saveAttributeOptionCommand
            ->withCommandGroupId("attribute_option.product.{$attributeOption->getAttributeCode()}.{$attributeOption->getValue()}")
            ->withShardingKey($attributeOption->getAttributeCode());
    }

    public function getAttributeOption(): AttributeOption
    {
        return $this->attributeOption;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->attributeOption->equals($object->attributeOption)
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + $this->attributeOption->toJson();
    }

    /** @var AttributeOption */
    private $attributeOption;

    public function __construct()
    {

    }
}
