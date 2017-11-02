<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\ProductDataSet;

class ProductDataSetTest extends TestCase
{
    public function testWithers()
    {
        $productDataSet = ProductDataSet::of([
            ProductData::of('acme-t-shirt', 'ACME T-Shirts'),
            ProductData::of('acme-trousers', 'ACME Trousers'),
            ProductData::of('acme-leggings', 'ACME Leggings'),
            ProductData::of('acme-ties', 'ACME Ties'),
        ]);

        $productDataSet = $productDataSet->with(ProductData::of('acme-socks', 'ACME Socks'));
        self::assertTrue($productDataSet->equals(ProductDataSet::of([
            ProductData::of('acme-t-shirt', 'ACME T-Shirts'),
            ProductData::of('acme-trousers', 'ACME Trousers'),
            ProductData::of('acme-leggings', 'ACME Leggings'),
            ProductData::of('acme-ties', 'ACME Ties'),
            ProductData::of('acme-socks', 'ACME Socks'),
        ])));

        $productDataSet = $productDataSet->with(ProductData::of('acme-socks', 'ACME Tailored Socks'));
        self::assertTrue($productDataSet->equals(ProductDataSet::of([
            ProductData::of('acme-t-shirt', 'ACME T-Shirts'),
            ProductData::of('acme-trousers', 'ACME Trousers'),
            ProductData::of('acme-leggings', 'ACME Leggings'),
            ProductData::of('acme-ties', 'ACME Ties'),
            ProductData::of('acme-socks', 'ACME Tailored Socks'),
        ])));
    }
}