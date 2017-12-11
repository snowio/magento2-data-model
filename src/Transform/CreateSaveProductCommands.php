<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\Command\SaveProductCommand;

final class CreateSaveProductCommands
{
    public static function fromProductDataDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromProductData());
    }

    public static function fromProductData(): Transform
    {
        return MapElements::via(function (ProductData $productData) {
            return SaveProductCommand::of($productData);
        });
    }
}
