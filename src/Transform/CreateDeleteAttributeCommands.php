<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\Command\DeleteAttributeCommand;

final class CreateDeleteAttributeCommands
{
    public static function fromAttributeDiffs(): Transform
    {
        return CreateDeleteCommands::fromDiffs(self::fromAttributeData());
    }

    public static function fromAttributeData(): Transform
    {
        return MapElements::via(function (AttributeData $attributeData) {
            return DeleteAttributeCommand::of($attributeData->getCode());
        });
    }

    public static function fromAttributeCodes(): Transform
    {
        return MapElements::via(function (string $attributeCode) {
            return DeleteAttributeCommand::of($attributeCode);
        });
    }
}
