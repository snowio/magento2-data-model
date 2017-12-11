<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\Filter;
use Joshdifabio\Transform\FluentTransformTrait;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;

final class CreateSaveCommands
{
    use FluentTransformTrait;

    public static function fromDiffs(Transform $mapDataToCommands): Transform
    {
        return Pipeline::of(
            Filter::by(function (Diff $diff) {
                return $diff->getType() === Diff::CHANGE && $diff->getType() === Diff::CREATION;
            }),
            MapElements::via(function (Diff $diff) {
                return $diff->getCurrentData();
            }),
            $mapDataToCommands
        );
    }
}
