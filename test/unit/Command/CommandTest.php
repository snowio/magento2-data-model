<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\Command;

class CommandTest extends TestCase
{

    public function testToJson()
    {
        /** @var Command $command */
        $command = $this->createCommand()
                ->withTimestamp(1509530316)
                ->withShardingKey('testCode')
                ->withCommandGroupId('test.group.id');
        self::assertEquals([
            '@timestamp' => 1509530316,
            '@shardingKey' => 'testCode',
            '@commandGroupId' => 'test.group.id',
         ], $command->toJson());

        $command = $this->createCommand()->withTimestamp(1509530316)
        ->withShardingKey('testCode');
        self::assertEquals([
            '@timestamp' => 1509530316,
            '@shardingKey' => 'testCode',
        ], $command->toJson());

        $command = $this->createCommand()->withTimestamp(1509530316);
        self::assertEquals([
            '@timestamp' => 1509530316,
        ], $command->toJson());

        $command = $this->createCommand();
        self::assertEquals([], $command->toJson());
    }

    public function testWithers()
    {
        /** @var Command $command */
        $command = $this->createCommand()->withTimestamp(1509530316)
            ->withShardingKey('testCode')
            ->withCommandGroupId('test.group.id');
        self::assertEquals(1509530316, $command->getTimestamp());
        self::assertEquals('testCode', $command->getShardingKey());
        self::assertEquals('test.group.id', $command->getCommandGroupId());
    }


    public function createCommand()
    {
        $commandClass = new class extends Command {};
        return new $commandClass;
    }
}