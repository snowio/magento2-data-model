<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\Command\SaveCategoryCommand;

class SaveCategoryCommandTest extends TestCase
{
    public function testToJson()
    {
        /** @var SaveCategoryCommand $command */
        $command = SaveCategoryCommand::of(CategoryData::of('mens_tshirts', 'Mens T-Shirts')
            ->withParentCode('t_shirts'));
        self::assertEquals([
            '@store' => 'admin',
            'category' => [
                'name' => 'Mens T-Shirts',
                'is_active' => true,
                'custom_attributes' => [],
                'extension_attributes' => [
                    'code' => 'mens_tshirts',
                    'parent_code' => 't_shirts',
                ],
            ],
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $expectedCategoryData = CategoryData::of('mens_tshirts', 'Mens T-shirts');
        /** @var SaveCategoryCommand $command */
        $command = SaveCategoryCommand::of(CategoryData::of('mens_tshirts', 'Mens T-shirts'));
        self::assertTrue($expectedCategoryData->equals($command->getCategoryData()));

    }
}
