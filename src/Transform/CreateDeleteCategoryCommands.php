<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\Distinct;
use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\DeleteCategoryCommand;

final class CreateDeleteCategoryCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            GetDeletedItems::fromIterables(function (CategoryData $categoryData) {
                return $categoryData->getCode();
            }),
            self::fromCategoryData()
        );
    }

    public static function fromCategoryData(): Transform
    {
        return Pipeline::of(
            MapElements::via(function (CategoryData $previousCategoryData) {
                return $previousCategoryData->getCode();
            }),
            self::fromCategoryCodes()
        );
    }

    public static function fromCategoryCodes(): Transform
    {
        return Pipeline::of(
            Distinct::create(),
            MapElements::via(function (string $attributeCode) {
                return DeleteCategoryCommand::of($attributeCode);
            })
        );
    }
}
