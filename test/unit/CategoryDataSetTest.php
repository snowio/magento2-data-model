<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\CategoryDataSet;
use SnowIO\Magento2DataModel\Command\DeleteCategoryCommand;
use SnowIO\Magento2DataModel\Command\SaveCategoryCommand;

class CategoryDataSetTest extends TestCase
{
    use CommandHelper;

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

    public function testMapToSaveCommand()
    {
        $categorySet = CategoryDataSet::of([
            CategoryData::of('mens_shoes', 'Men\'s Shoes'),
            CategoryData::of('mens_shirts', 'Men\'s Shirts'),
        ]);

        $expectedSet = [
            'mens_shoes admin' => SaveCategoryCommand::of(CategoryData::of('mens_shoes', 'Men\'s Shoes'))->withTimestamp(1509613892),
            'mens_shirts admin' => SaveCategoryCommand::of(CategoryData::of('mens_shirts', 'Men\'s Shirts'))->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedSet), $this->getJson($categorySet->mapToSaveCommands(1509613892)));
    }

    public function testMapToDeleteCommand()
    {
        $categorySet = CategoryDataSet::of([
            CategoryData::of('mens_shoes', 'Men\'s Shoes'),
            CategoryData::of('mens_shirts', 'Men\'s Shirts'),
        ]);

        //todo what about delete in different stores?
        $expectedSet = [
            'mens_shoes admin' => DeleteCategoryCommand::of('mens_shoes')->withTimestamp(1509613892),
            'mens_shirts admin' => DeleteCategoryCommand::of('mens_shirts')->withTimestamp(1509613892),
        ];

        self::assertEquals($this->getJson($expectedSet), $this->getJson($categorySet->mapToDeleteCommands(1509613892)));
    }
}
