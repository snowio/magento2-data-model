<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\Filter;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\MoveCategoryCommand;

final class CreateMoveCategoryCommands
{
    public static function fromCategoryDiffs(): Transform
    {
        return Pipeline::of(
            Filter::by(function (Diff $diff) {
                return $diff->getType() === Diff::CHANGE;
            }),
            Filter::by(Diff::unpack(function (CategoryData $previousData, CategoryData $currentData) {
                return $previousData->getParentCode() !== $currentData->getParentCode();
            })),
            MapElements::via(function (Diff $diff) {
                return $diff->getCurrentData();
            }),
            self::fromCategoryData()
        );
    }

    public static function fromCategoryData(): Transform
    {
        return MapElements::via(function (CategoryData $categoryData) {
            return MoveCategoryCommand::of($categoryData->getCode(), $categoryData->getParentCode());
        });
    }
}
