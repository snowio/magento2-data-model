<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\Distinct;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\Command\DeleteProductCommand;

final class CreateDeleteProductCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            GetDeletedItems::fromIterables(function (ProductData $productData) {
                return $productData->getSku();
            }),
            self::fromProductData()
        );
    }

    public static function fromProductData(): Transform
    {
        return Pipeline::of(
            MapElements::via(function (ProductData $previousProductData) {
                return $previousProductData->getSku();
            }),
            self::fromSkus()
        );
    }

    public static function fromSkus(): Transform
    {
        return Pipeline::of(
            Distinct::create(),
            MapElements::via(function (string $productSku) {
                return DeleteProductCommand::of($productSku);
            })
        );
    }
}
