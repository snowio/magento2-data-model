<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\Filter;
use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;

final class CreateSaveCommands
{
    public static function fromDiffs(Transform $mapDataToCommands): Transform
    {
        return Pipeline::of(
            Filter::by(function (Diff $diff) {
                return $diff->getType() === Diff::CHANGE || $diff->getType() === Diff::CREATION;
            }),
            MapElements::via(function (Diff $diff) {
                return $diff->getCurrentData();
            }),
            $mapDataToCommands
        );
    }
}
