<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;

final class CreateDeleteAttributeOptionCommands
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
        return CreateDeleteCommands::fromDiffs(self::fromAttributeOptions());
    }

    public static function fromAttributeOptions(): Transform
    {
        return MapElements::via(function (AttributeOption $attributeOption) {
            return DeleteAttributeOptionCommand::of($attributeOption->getAttributeCode(), $attributeOption->getValue());
        });
    }
}
