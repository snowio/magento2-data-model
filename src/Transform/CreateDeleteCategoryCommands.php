<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\DeleteCategoryCommand;

final class CreateDeleteCategoryCommands
{
    public static function fromCategoryDiffs(): Transform
    {
        return CreateDeleteCommands::fromDiffs(self::fromCategoryData());
    }

    public static function fromCategoryData(): Transform
    {
        return MapElements::via(function (CategoryData $previousCategoryData) {
            return DeleteCategoryCommand::of($previousCategoryData->getCode());
        });
    }

    public static function fromCategoryCodes(): Transform
    {
        return MapElements::via(function (string $attributeCode) {
            return DeleteCategoryCommand::of($attributeCode);
        });
    }
}
