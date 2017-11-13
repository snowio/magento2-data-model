<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\ProductCategoryAssociation;

class ProductCategoryAssociationTest extends TestCase
{
    public function testToJson()
    {
        $productCategoryAssociation = ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2']);
        self::assertEquals([
          'productSku' => 'test-snowio-product',
          'categoryCodes' => ['category1', 'category2'],
        ], $productCategoryAssociation->toJson());
    }

    public function testWithers()
    {
        $productCategoryAssociation = ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2'])
            ->withCategoryCode('category3');

        self::assertTrue(
            ProductCategoryAssociation::of(
                'test-snowio-product',
                ['category1', 'category2', 'category3'])->equals($productCategoryAssociation)
        );

        $productCategoryAssociation = ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2'])
            ->withCategoryCodes(['category3', 'category4']);

        self::assertTrue(
            ProductCategoryAssociation::of(
                'test-snowio-product',
                ['category3', 'category4'])->equals($productCategoryAssociation)
        );
    }

    public function testEquals()
    {
        $productCategoryAssociation =
            ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2']);
        self::assertTrue(
            ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2'])
            ->equals($productCategoryAssociation)
        );
        self::assertFalse(
            ProductCategoryAssociation::of('test-snowio-product', ['category1', 'category2'])
                ->equals($productCategoryAssociation->withCategoryCode('category3'))
        );
        self::assertFalse(
            ProductCategoryAssociation::of('test-snowio-product', ['category1'])
                ->equals(CategoryData::of('category1', 'Category1'))
        );
    }
}