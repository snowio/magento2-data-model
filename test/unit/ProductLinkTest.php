<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductLink;

class ProductLinkTest extends TestCase
{
    public function testToJson()
    {
        $productLink = ProductLink::of('SKU001', 'SKU002');
        self::assertEquals([
            'sku' => 'SKU001',
            'linked_product_sku' => 'SKU002',
            'linked_product_type' => 'simple',
            'link_type' => null,
            'position' => 0,
            'extension_attributes' => [],
        ], $productLink->toJson());
    }

    public function testAccessors()
    {
        $productLink = ProductLink::of('xxx', 'yyy');
        self::assertEquals('xxx', $productLink->getSku());
        self::assertEquals('yyy', $productLink->getLinkedProductSku());
    }

    public function testEquals()
    {
        $productLink = ProductLink::of('XYZ', 'YYY');
        $otherProductLink = ProductLink::of('XYZ', 'YYY');
        self::assertTrue($productLink->equals($otherProductLink));
        self::assertFalse((ProductLink::of('a', 'a'))->equals(ProductLink::of('b', 'b')));
    }
}
