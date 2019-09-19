<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\SaveCategoryCommand;

final class CreateSaveCategoryCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            CreateDiffs::fromIterables(function (CategoryData $categoryData) {
                return \implode(' ', [$categoryData->getCode(), $categoryData->getStoreCode()]);
            }),
            self::fromDiffs()
        );
    }

    public static function fromDiffs(): Transform
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
