<?php
namespace SnowIO\Magento2DataModel\Test\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\SaveSourceItemsCommand;
use SnowIO\Magento2DataModel\Test\Inventory\SourceItemHelpers;

class SaveSourceItemsCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = SaveSourceItemsCommand::of(SourceItemHelpers::getSourceItems())
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
        $command = SaveSourceItemsCommand::of(SourceItemHelpers::getSourceItems());
        self::assertTrue(SourceItemHelpers::getSourceItems()->equals($command->getSourceItems()));
    }
}
