<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteCategoryCommand;

class DeleteCategoryCommandTest extends TestCase
{
    public function testToJson()
    {
        /** @var DeleteCategoryCommand $command */
        $command = DeleteCategoryCommand::of('mens_tshirts')->withTimestamp(123);
        self::assertEquals([
            '@timestamp' => (float)123,
            '@shardingKey' => 'mens_tshirts',
            '@commandGroupId' => 'category.mens_tshirts',
            'categoryCode' => 'mens_tshirts',
        ], $command->toJson());
    }

    public function testAccessors()
    {
        /** @var DeleteCategoryCommand $command */
        $command = DeleteCategoryCommand::of('mens_tshirt');
        self::assertEquals('mens_tshirt', $command->getCategoryCode());
    }
}
