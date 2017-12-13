<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\Distinct;
use Joshdifabio\Transform\Filter;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\MapValues;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\MoveCategoryCommand;

final class CreateMoveCategoryCommands
{
    public static function fromIterables(): Transform
    {
        $getKeyFn = function (CategoryData $categoryData) {
            return $categoryData->getCode();
        };

        return Pipeline::of(
            MapValues::via(function ($iterable) use ($getKeyFn) {
                return Distinct::withRepresentativeValueFn($getKeyFn)->applyTo($iterable);
            }),
            CreateDiffs::fromIterables($getKeyFn),
            self::fromDiffs()
        );
    }

    public static function fromDiffs(): Transform
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
