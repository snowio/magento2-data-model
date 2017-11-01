<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\CategoryDataSet;

class CategoryDataSetTest extends TestCase
{
    public function testWither()
    {
        $categoryDataSet = CategoryDataSet::of([
            CategoryData::of('mens_shoes', 'Men\'s Shoes'),
            CategoryData::of('mens_shirts', 'Men\'s Shirts'),
            CategoryData::of('mens_underware', 'Men\'s Underware'),
        ]);

        $categoryDataSet = $categoryDataSet->with(CategoryData::of('mens_watches', 'Men\'s Watches'));
        self::assertTrue($categoryDataSet->equals(CategoryDataSet::of([
            CategoryData::of('mens_shoes', 'Men\'s Shoes'),
            CategoryData::of('mens_shirts', 'Men\'s Shirts'),
            CategoryData::of('mens_underware', 'Men\'s Underware'),
            CategoryData::of('mens_watches', 'Men\'s Watches'),
        ])));

        $categoryDataSet = $categoryDataSet->with(CategoryData::of('mens_underware', 'Men\'s Briefs'));

        self::assertTrue($categoryDataSet->equals(CategoryDataSet::of([
            CategoryData::of('mens_shoes', 'Men\'s Shoes'),
            CategoryData::of('mens_shirts', 'Men\'s Shirts'),
            CategoryData::of('mens_underware', 'Men\'s Briefs'),
            CategoryData::of('mens_watches', 'Men\'s Watches'),
        ])));
    }

}
