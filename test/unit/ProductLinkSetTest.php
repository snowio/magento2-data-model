<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductLink;
use SnowIO\Magento2DataModel\ProductLinkSet;

class ProductLinkSetTest extends TestCase
{
    public function testDefaultValues()
    {
        $productLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type')->withQty(1),
        ]);

        self::assertEquals([[
            'sku' => 'a',
            'linked_product_sku' => 'b',
            'linked_product_type' => 'simple',
            'link_type' => 'type',
            'position' => 0,
            'extension_attributes' => [
                'qty' => 1
            ]
        ]], $productLinkSet->toJson());
    }
    public function testToJson()
    {
        $productLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type'),
            ProductLink::of('b', 'b', 'type'),
            ProductLink::of('c', 'b', 'type'),
        ]);

        self::assertEquals([
            [
                'sku' => 'a',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => 'type',
                'position' => 0,
                'extension_attributes' => []
            ],
            [
                'sku' => 'b',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => 'type',
                'position' => 0,
                'extension_attributes' => []
            ],
            [
                'sku' => 'c',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => 'type',
                'position' => 0,
                'extension_attributes' => []
            ],
        ], $productLinkSet->toJson());
    }

    /**
     * @expectedException SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Cannot set ProductLink with same sku linked_product_sku, link_type
     */
    public function testInvalidSetProductLinkTwice()
    {
        ProductLinkSet::of([
            ProductLink::of('a', 'a', 'type'),
            ProductLink::of('a', 'a', 'type'),
            ProductLink::of('b', 'a', 'type'),
        ]);
    }

    public function testWitherToSet()
    {
        /** @var $productLinkSet ProductLinkSet */
        $productLinkSet = ProductLinkSet::create();

        self::assertTrue($productLinkSet->isEmpty());

        $productLinkSet = $productLinkSet
            ->withProductLink(ProductLink::of('d', 'x', 'type'));

        self::assertEquals(1, $productLinkSet->count());

        $productLinkSet = $productLinkSet
            ->withProductLink(ProductLink::of('a', 'x', 'type'))
            ->withProductLink(ProductLink::of('b', 'x', 'type'))
            ->withProductLink(ProductLink::of('c', 'x', 'type'));

        $expectedProductLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'x', 'type'),
            ProductLink::of('b', 'x', 'type'),
            ProductLink::of('c', 'x', 'type'),
            ProductLink::of('d', 'x', 'type'),
        ]);

        self::assertTrue($expectedProductLinkSet->equals($productLinkSet));
    }

    public function testAddToSet()
    {
        $productLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type'),
        ]);

        $anotherProductLink = ProductLinkSet::of([
            ProductLink::of('b', 'b', 'type'),
            ProductLink::of('c', 'b', 'type'),
        ]);

        $productLinkSet = $productLinkSet->add($anotherProductLink);
        $expectedProductLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type'),
            ProductLink::of('b', 'b', 'type'),
            ProductLink::of('c', 'b', 'type'),
        ]);

        self::assertTrue($expectedProductLinkSet->equals($productLinkSet));
    }

    public function testEquality()
    {
        $productLink = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type'),
            ProductLink::of('b', 'b', 'type'),
            ProductLink::of('c', 'b', 'type'),
        ]);

        $otherProductLink = ProductLinkSet::of([
            ProductLink::of('a', 'b', 'type'),
            ProductLink::of('b', 'b', 'type'),
            ProductLink::of('c', 'b', 'type'),
        ]);

        self::assertTrue($productLink->equals($otherProductLink));
    }
}
