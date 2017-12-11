<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;

final class CreateDeleteAttributeOptionCommands
{
    public static function fromAttributeOptionDiffs(): Transform
    {
        return CreateDeleteCommands::fromDiffs(self::fromAttributeOptions());
    }

    public static function fromAttributeOptions(): Transform
    {
        return MapElements::via(function (AttributeOption $attributeOption) {
            return DeleteAttributeOptionCommand::of($attributeOption->getAttributeCode(), $attributeOption->getValue());
        });
    }
}
