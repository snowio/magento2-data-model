<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\SaveCategoryCommand;

final class CreateSaveCategoryCommands
{
    public static function fromCategoryDataDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromCategoryData());
    }

    public static function fromCategoryData(): Transform
    {
        return MapElements::via(function (CategoryData $categoryData) {
            return SaveCategoryCommand::of($categoryData);
        });
    }
}
