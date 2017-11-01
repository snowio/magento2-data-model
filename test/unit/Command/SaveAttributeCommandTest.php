<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeData;
use SnowIO\Magento2DataModel\Command\SaveAttributeCommand;
use SnowIO\Magento2DataModel\FrontendInput;

class SaveAttributeCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = SaveAttributeCommand::of(AttributeData::of('volume', FrontendInput::TEXT, 'Volume'))
        ->withTimestamp(1509530316)
        ->withShardingKey('volume');
        self::assertEquals([
            '@timestamp' => 1509530316,
            '@shardingKey' => 'volume',
            'attribute' => [
                'attribute_code' => 'volume',
                'is_required' => false,
                'frontend_input' => 'text',
                'default_frontend_label' => 'Volume',
            ],
        ], $command->toJson());
    }

    public function getAccessor()
    {
        $attributeData = AttributeData::of('volume', FrontendInput::TEXT, 'Volume');
        $command = SaveAttributeCommand::of($attributeData);
        self::assertTrue($attributeData->equals($command->getAttributeData()));
    }
}