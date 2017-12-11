<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\Filter;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;

final class CreateDeleteCommands
{
    public static function fromDiffs(Transform $mapDataToCommands): Transform
    {
        return Pipeline::of(
            Filter::by(function (Diff $diff) {
                return $diff->getType() === Diff::DELETION;
            }),
            MapElements::via(function (Diff $diff) {
                return $diff->getPreviousData();
            }),
            $mapDataToCommands
        );
    }
}
