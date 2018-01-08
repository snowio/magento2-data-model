<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\SaveAttributeOptionCommand;

class SaveAttributeOptionCommandTest extends TestCase
{
    public function testToJson()
    {
        /** @var SaveAttributeOptionCommand $command */
        $command = SaveAttributeOptionCommand::of(AttributeOption::of('size', 'large', 'Large'))
            ->withTimestamp(123);
        self::assertEquals([
            '@timestamp' => (float)123,
            '@shardingKey' => 'size',
            '@commandGroupId' => 'attribute_option.product.size.large',
            'entity_type' => 4,
            'attribute_code' => 'size',
            'option' => [
                'value' => 'large',
                'label' => 'Large',
            ],
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $expectedAttributeOption = AttributeOption::of('size', 'large', 'Large');
        $command = SaveAttributeOptionCommand::of(AttributeOption::of('size', 'large', 'Large'));
        self::assertTrue($command->getAttributeOption()->equals($expectedAttributeOption));
    }
}
