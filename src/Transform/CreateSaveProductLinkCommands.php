<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\Command\SaveProductLinkAssociationCommand;
use SnowIO\Magento2DataModel\ProductLinkAssociation;

class CreateSaveProductLinkCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            CreateDiffs::fromIterables(function (ProductLinkAssociation $links) {
                return $links->getProductSku() . $links->getLinkType() . $links->getLinkedProductSku();
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
        return MapElements::via(function (ProductLinkAssociation $productLinks) {
            return SaveProductLinkAssociationCommand::of($productLinks);
        });
    }
}
