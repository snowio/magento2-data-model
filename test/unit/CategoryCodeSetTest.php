<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\CategoryCodeSet;

class CategoryCodeSetTest extends TestCase
{
    public function testToArray()
    {
        $productCategoryAssociation = CategoryCodeSet::of(['category1', 'category2']);
        self::assertSame(['category1', 'category2'], $productCategoryAssociation->toArray());
    }

    public function testWith()
    {
        $productCategoryAssociation = CategoryCodeSet::of(['category1', 'category2'])->with('category3');

        self::assertTrue(
            $productCategoryAssociation->equals(CategoryCodeSet::of(['category1', 'category2', 'category3']))
        );
    }

    public function testAdd()
    {
        $productCategoryAssociation = CategoryCodeSet::of(['category1', 'category2'])
            ->add(CategoryCodeSet::of(['category3', 'category4']));

        self::assertTrue(
            $productCategoryAssociation->equals(CategoryCodeSet::of(['category1', 'category2', 'category3', 'category4']))
        );
    }

    public function testEquals()
    {
        $productCategoryAssociation = CategoryCodeSet::of(['category1', 'category2']);
        self::assertTrue(
            $productCategoryAssociation->equals(CategoryCodeSet::of(['category1', 'category2']))
        );
        self::assertFalse(
            $productCategoryAssociation->with('category3')->equals(CategoryCodeSet::of(['category1', 'category2']))
        );
        self::assertFalse(
            CategoryCodeSet::of(['category1'])->equals(CategoryData::of('category1', 'Category1'))
        );
    }
}
