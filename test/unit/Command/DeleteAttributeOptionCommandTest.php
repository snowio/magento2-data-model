<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;

class DeleteAttributeOptionCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = DeleteAttributeOptionCommand::of('size', 'large')->withTimestamp(1509530316);
        self::assertEquals([
            '@timestamp' => (float)1509530316,
            '@shardingKey' => 'size',
            '@commandGroupId' => 'attribute_option.product.size.large',
            'entityType' => 4,
            'attributeCode' => 'size',
            'optionCode' => 'large',
        ], $command->toJson());
    }

    public function testWither()
    {
        $command = DeleteAttributeOptionCommand::of('size', 'large')
            ->withEntityType(8);
        self::assertEquals(8, $command->getEntityType());
    }

    public function testAccessor()
    {
        $command = DeleteAttributeOptionCommand::of('size', 'large');
        self::assertEquals('size', $command->getAttributeCode());
        self::assertEquals('large', $command->getOptionCode());
    }
}
