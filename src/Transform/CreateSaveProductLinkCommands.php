<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use SnowIO\Magento2DataModel\Command\SaveProductLinkAssociationCommand;
use SnowIO\Magento2DataModel\ProductLinkAssociation;

class CreateSaveProductLinkCommands
{
    public static function fromIterables(): Transform
    {
        $output = Pipeline::of(
            CreateDiffs::fromIterables(function (ProductLinkAssociation $links) {
                return $links->getProductSku();
            }),
            self::fromDiffs()
        );

        return $output;
    }

    public static function fromDiffs(): Transform
    {
        return CreateSaveCommands::fromDiffs(self::fromAssociations());
    }

    public static function fromAssociations(): Transform
    {
        return MapElements::via(function (ProductLinkAssociation $productLinks) {
            return SaveProductLinkAssociationCommand::of($productLinks);
        });
    }
}
