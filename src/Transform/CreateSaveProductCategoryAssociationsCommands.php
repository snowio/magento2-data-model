<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\Command\SaveProductCategoryAssociationsCommand;
use SnowIO\Magento2DataModel\ProductCategoryAssociations;

class CreateSaveProductCategoryAssociationsCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            CreateDiffs::fromIterables(function (ProductCategoryAssociations $associations) {
                return $associations->getProductSku();
            }),
            self::fromDiffs()
        );
    }

    public static function fromDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromAssociations());
    }

    public static function fromAssociations(): Transform
    {
        return MapElements::via(function (ProductCategoryAssociations $associations) {
            return SaveProductCategoryAssociationsCommand::of($associations);
        });
    }
}
