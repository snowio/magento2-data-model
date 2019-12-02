<?php
namespace SnowIO\Magento2DataModel\Test\Inventory;

use PHPUnit\Framework\TestCase;

class SourceItemDataTest extends TestCase
{
    public function testJson()
    {
        self::assertEquals(
            SourceItemHelpers::getSourceItem('1','1')->toJson(),
            SourceItemHelpers::getSourceItemJson('1', '1')
        );
    }

    public function testAccessors()
    {
        $sourceItem = SourceItemHelpers::getSourceItem('1', '1', 50, 'another');
        self::assertEquals('1', $sourceItem->getSku());
        self::assertEquals('1', $sourceItem->getSourceCode());
        self::assertEquals(50, $sourceItem->getQuantity());
        self::assertEquals('another', $sourceItem->getStatus());
    }

    public function testEquals()
    {
        $sourceItem = SourceItemHelpers::getSourceItem('1', '1');
        self::assertTrue(
            $sourceItem->equals(SourceItemHelpers::getSourceItem('1', '1'))
        );
        self::assertFalse(
            $sourceItem->withQuantity(40)
                ->equals(SourceItemHelpers::getSourceItem('1', '1'))
        );
    }

    public function testWitherToSet()
    {
        $sourceItem = SourceItemHelpers::getSourceItem('1', '1')
            ->withQuantity(100)
            ->withStatus('Test');

        self::assertEquals('1', $sourceItem->getSku());
        self::assertEquals('1', $sourceItem->getSourceCode());
        self::assertEquals(100, $sourceItem->getQuantity());
        self::assertEquals('Test', $sourceItem->getStatus());

        $sourceItem = $sourceItem
            ->withSku('e92u3902')
            ->withSourceCode('32u092u90');
        self::assertEquals('e92u3902', $sourceItem->getSku());
        self::assertEquals('32u092u90', $sourceItem->getSourceCode());
    }
}
