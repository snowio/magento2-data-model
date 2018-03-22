<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductLink;

class ProductLinkTest extends TestCase
{
    public function testToJson()
    {
        $productLink = ProductLink::of('SKU001', 'SKU002', ProductLink::LINK_TYPE_ASSOCIATED);
        self::assertEquals([
            'sku' => 'SKU001',
            'linked_product_sku' => 'SKU002',
            'linked_product_type' => 'simple',
            'link_type' => 'associated',
            'position' => 0,
            'extension_attributes' => [],
        ], $productLink->toJson());
    }

    public function testAccessors()
    {
        $productLink = ProductLink::of('xxx', 'yyy', ProductLink::LINK_TYPE_ASSOCIATED);
        self::assertEquals('xxx', $productLink->getSku());
        self::assertEquals('yyy', $productLink->getLinkedProductSku());
        self::assertEquals('associated', $productLink->getLinkType());
    }

    public function testEquals()
    {
        $productLink = ProductLink::of('XYZ', 'YYY', 'type');
        $otherProductLink = ProductLink::of('XYZ', 'YYY', 'type');
        self::assertTrue($productLink->equals($otherProductLink));
        self::assertFalse((ProductLink::of('a', 'a', 'type'))->equals(
            ProductLink::of('b', 'b', 'type')
        ));
    }
}
