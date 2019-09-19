<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\SaveAttributeOptionCommand;

final class CreateSaveAttributeOptionCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            CreateDiffs::fromIterables(function (AttributeOption $attributeOption) {
                return \implode(' ', [$attributeOption->getAttributeCode(), $attributeOption->getValue()]);
            }),
            self::fromDiffs()
        );
    }

    public static function fromDiffs(): Transform
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
