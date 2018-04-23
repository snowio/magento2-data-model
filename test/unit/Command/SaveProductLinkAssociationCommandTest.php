<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use SnowIO\Magento2DataModel\Command\SaveProductLinkAssociationCommand;
use SnowIO\Magento2DataModel\ProductLink;
use SnowIO\Magento2DataModel\ProductLinkAssociation;

class SaveProductLinkAssociationCommandTest extends CommandTest
{
    public function testToJson()
    {
        $productLink = ProductLink::of('skuA', 'skuB', ProductLink::LINK_TYPE_ASSOCIATED);

        $time = time();
        $links = ProductLinkAssociation::of($productLink);
        $command = SaveProductLinkAssociationCommand::of($links)
            ->withTimestamp($time);

        self::assertEquals([
            '@timestamp' => (float)$time,
            '@shardingKey' => 'skuA',
            '@commandGroupId' => 'product.product_links.skuA.associated.skuB',
            'sku' => $productLink->getSku(),
            'entity' => $productLink->toJson(),
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $productLink = ProductLink::of('skuA', 'skuB', ProductLink::LINK_TYPE_ASSOCIATED);

        $links = ProductLinkAssociation::of($productLink);
        $command = SaveProductLinkAssociationCommand::of($links);

        self::assertSame('skuA', $command->getProductSku());
        self::assertTrue($command->getData()->equals($links));
    }

    public function testEquals()
    {
        $productLink = ProductLink::of('skuA', 'skuB', ProductLink::LINK_TYPE_ASSOCIATED);
        $link1 = ProductLinkAssociation::of($productLink);
        $link2 = ProductLinkAssociation::of($productLink);
        self::assertTrue($link1->equals($link2));
    }
}
