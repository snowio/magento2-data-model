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
            ProductLink::of('a', 'b')->withQty(1),
        ]);

        self::assertEquals([[
            'sku' => 'a',
            'linked_product_sku' => 'b',
            'linked_product_type' => 'simple',
            'link_type' => null,
            'position' => 0,
            'extension_attributes' => [
                'qty' => 1
            ]
        ]], $productLinkSet->toJson());
    }
    public function testToJson()
    {
        $productLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b'),
            ProductLink::of('b', 'b'),
            ProductLink::of('c', 'b'),
        ]);

        self::assertEquals([
            [
                'sku' => 'a',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => null,
                'position' => 0,
                'extension_attributes' => []
            ],
            [
                'sku' => 'b',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => null,
                'position' => 0,
                'extension_attributes' => []
            ],
            [
                'sku' => 'c',
                'linked_product_sku' => 'b',
                'linked_product_type' => 'simple',
                'link_type' => null,
                'position' => 0,
                'extension_attributes' => []
            ],
        ], $productLinkSet->toJson());
    }

    /**
     * @expectedException SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Cannot set ProductLink with same sku linked_product_sku
     */
    public function testInvalidSetProductLinkTwice()
    {
        ProductLinkSet::of([
            ProductLink::of('a', 'a'),
            ProductLink::of('a', 'a'),
            ProductLink::of('b', 'a'),
        ]);
    }

    public function testWitherToSet()
    {
        $productLinkSet = ProductLinkSet::create();

        self::assertTrue($productLinkSet->isEmpty());

        $productLinkSet = $productLinkSet
            ->withProductLink(ProductLink::of('d', 'x'));

        self::assertEquals(1, $productLinkSet->count());

        $productLinkSet = $productLinkSet
            ->withProductLink(ProductLink::of('a', 'x'))
            ->withProductLink(ProductLink::of('b', 'x'))
            ->withProductLink(ProductLink::of('c', 'x'));

        $expectedProductLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'x'),
            ProductLink::of('b', 'x'),
            ProductLink::of('c', 'x'),
            ProductLink::of('d', 'x'),
        ]);

        self::assertTrue($expectedProductLinkSet->equals($productLinkSet));
    }

    public function testAddToSet()
    {
        $productLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b'),
        ]);

        $anotherProductLink = ProductLinkSet::of([
            ProductLink::of('b', 'b'),
            ProductLink::of('c', 'b'),
        ]);

        $productLinkSet = $productLinkSet->add($anotherProductLink);
        $expectedProductLinkSet = ProductLinkSet::of([
            ProductLink::of('a', 'b'),
            ProductLink::of('b', 'b'),
            ProductLink::of('c', 'b'),
        ]);

        self::assertTrue($expectedProductLinkSet->equals($productLinkSet));
    }

    public function testEquality()
    {
        $productLink = ProductLinkSet::of([
            ProductLink::of('a', 'b'),
            ProductLink::of('b', 'b'),
            ProductLink::of('c', 'b'),
        ]);

        $otherProductLink = ProductLinkSet::of([
            ProductLink::of('a', 'b'),
            ProductLink::of('b', 'b'),
            ProductLink::of('c', 'b'),
        ]);

        self::assertTrue($productLink->equals($otherProductLink));
    }
}
