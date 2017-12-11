<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\SaveAttributeOptionCommand;

final class CreateSaveAttributeOptionCommands
{
    public static function fromAttributeDataDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromAttributeOptions());
    }

    public static function fromAttributeOptions(): Transform
    {
        return MapElements::via(function (AttributeOption $attributeOption) {
            return SaveAttributeOptionCommand::of($attributeOption);
        });
    }
}
