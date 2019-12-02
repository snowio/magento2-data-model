<?php
namespace SnowIO\Magento2DataModel\Test\Inventory;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Inventory\SourceItemDataSet;

class SourceItemDataSetTest extends TestCase
{
    /**
     * @test
     * @expectedException \SnowIO\Magento2DataModel\MagentoDataException
     */
    public function shouldNotHaveInvalidSetFromDuplicationSources()
    {
        SourceItemDataSet::of([
            SourceItemHelpers::getSourceItem('1','1'),
            SourceItemHelpers::getSourceItem('1','1'),
            SourceItemHelpers::getSourceItem('2','2'),
        ]);
    }

    public function testEquality()
    {
        self::assertTrue(SourceItemHelpers::getSourceItems()->equals(SourceItemHelpers::getSourceItems()));
        self::assertFalse(SourceItemHelpers::getSourceItems()->equals(
            SourceItemHelpers::getSourceItems()->with(SourceItemHelpers::getSourceItem('1', '1'))
        ));
    }

    public function testWitherToSet()
    {
        $sourceItems = SourceItemDataSet::create();
        self::assertTrue($sourceItems->isEmpty());
        $sourceItems = $sourceItems->with(SourceItemHelpers::getSourceItem('1', '1'));
        $sourceItems = $sourceItems->with(SourceItemHelpers::getSourceItem('2', '2'));
        $sourceItems = $sourceItems->with(SourceItemHelpers::getSourceItem('3', '3'));
        self::assertTrue($sourceItems->equals(SourceItemDataSet::of([
            SourceItemHelpers::getSourceItem('1', '1'),
            SourceItemHelpers::getSourceItem('2', '2'),
            SourceItemHelpers::getSourceItem('3', '3'),
        ])));
    }

    public function testMapToSaveCommands()
    {
        $inputs = SourceItemHelpers::getSourceItems();
        $command = $inputs->mapToSaveCommand(0);
        self::assertTrue($command->getSourceItems()->equals($inputs));
    }

    public function testMapToDeleteCommands()
    {
        $inputs = SourceItemHelpers::getSourceItems();
        $command = $inputs->mapToDeleteCommand(0);
        self::assertTrue($command->getSourceItems()->equals($inputs));
    }
}
