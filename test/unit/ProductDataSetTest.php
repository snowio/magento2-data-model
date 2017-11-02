<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteProductCommand;
use SnowIO\Magento2DataModel\Command\SaveProductCommand;
use SnowIO\Magento2DataModel\ProductData;
use SnowIO\Magento2DataModel\ProductDataSet;

class ProductDataSetTest extends TestCase
{
    use CommandHelper;

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

    public function testMapToSaveCommand()
    {
        $productSet = ProductDataSet::of([
            ProductData::of('acme-t-shirt', 'ACME T-Shirts'),
            ProductData::of('acme-trousers', 'ACME Trousers'),
        ]);

        $expectedCommands = [
            'acme-t-shirt admin' => SaveProductCommand::of(ProductData::of('acme-t-shirt', 'ACME T-Shirts'))->withTimestamp(1509613892),
            'acme-trousers admin' => SaveProductCommand::of(ProductData::of('acme-trousers', 'ACME Trousers'))->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedCommands), $this->getJson($productSet->mapToSaveCommands(1509613892)));
    }

    public function testMapToDeleteCommand()
    {
        $productSet = ProductDataSet::of([
            ProductData::of('acme-t-shirt', 'ACME T-Shirts'),
            ProductData::of('acme-trousers', 'ACME Trousers'),
        ]);
        //todo what about delete in different scopes should the command also require the store?
        $expectedCommands = [
            'acme-t-shirt admin' => DeleteProductCommand::of('acme-t-shirt')->withTimestamp(1509613892),
            'acme-trousers admin' => DeleteProductCommand::of('acme-trousers')->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedCommands), $this->getJson($productSet->mapToDeleteCommands(1509613892)));
    }
}