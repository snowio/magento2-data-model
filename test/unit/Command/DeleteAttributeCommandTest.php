<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteAttributeCommand;

class DeleteAttributeCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = DeleteAttributeCommand::of('volume')
            ->withTimestamp(1509530316)
            ->withShardingKey('volume');

        self::assertEquals([
            '@shardingKey' => 'volume',
            '@timestamp' => 1509530316,
            'attributeCode' => 'volume',
        ], $command->toJson());
    }

    public function testAccessor()
    {
        $command = DeleteAttributeCommand::of('volume');
        self::assertEquals('volume', $command->getAttributeCode());
    }
}