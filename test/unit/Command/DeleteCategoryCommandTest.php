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
        $command = DeleteCategoryCommand::of('mens_tshirt');
        self::assertEquals([
            'categoryCode' => 'mens_tshirt',
        ], $command->toJson());
    }

    public function testAccessors()
    {
        /** @var DeleteCategoryCommand $command */
        $command = DeleteCategoryCommand::of('mens_tshirt');
        self::assertEquals('mens_tshirt', $command->getCategoryCode());
    }
}