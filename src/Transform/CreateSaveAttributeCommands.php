<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\Command\SaveAttributeCommand;

final class CreateSaveAttributeCommands
{
    public static function fromAttributeDataDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromAttributeData());
    }

    public static function fromAttributeData(): Transform
    {
        return MapElements::via(function (AttributeData $attributeData) {
            return SaveAttributeCommand::of($attributeData);
        });
    }
}
