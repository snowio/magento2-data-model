<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeSetData;
use SnowIO\Magento2DataModel\Command\SaveAttributeSetCommand;

final class CreateSaveAttributeSetCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            CreateDiffs::fromIterables(function (AttributeSetData $attributeSetData) {
                return $attributeSetData->getCode();
            }),
            self::fromDiffs()
        );
    }

    public static function fromDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromAttributeSetData());
    }

    public static function fromAttributeSetData(): Transform
    {
        return MapElements::via(function (AttributeSetData $attributeSetData) {
            return SaveAttributeSetCommand::of($attributeSetData);
        });
    }
}
