<?php
namespace SnowIO\Magento2DataModel\Test\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteSourceItemsCommand;
use SnowIO\Magento2DataModel\Test\Inventory\SourceItemHelpers;

class DeleteSourceItemsCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = DeleteSourceItemsCommand::of(SourceItemHelpers::getSourceItems())
            ->withShardingKey('sku')
            ->withCommandGroupId("source_item.sku")
            ->withTimestamp(123);
        self::assertEquals([
            '@timestamp' => 123,
            '@shardingKey' => 'sku',
            '@commandGroupId' => 'source_item.sku',
            'sourceItems' => SourceItemHelpers::getSourceItemsJson(),
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $command = DeleteSourceItemsCommand::of(SourceItemHelpers::getSourceItems());
        self::assertTrue(SourceItemHelpers::getSourceItems()->equals($command->getSourceItems()));
    }
}
