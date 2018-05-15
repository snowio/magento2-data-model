<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomerData;
use SnowIO\Magento2DataModel\Command\SaveCustomerCommand;

class SaveCustomerCommandTest extends TestCase
{
    public function testToJson()
    {
        $command = SaveCustomerCommand::of(CustomerData::of('test@amp.co'))
        ->withTimestamp(1509530316);
        self::assertEquals([
            '@timestamp' => (float)1509530316,
            'customer' => [
                'id' => null,
                'email' => 'test@amp.co',
                'firstname' => null,
                'lastname' => null,
                'group_id' => null,
                'default_billing' => null,
                'default_shipping' => null,
                'confirmation' => null,
                'created_in' => null,
                'dob' => null,
                'middlename' => null,
                'prefix' => null,
                'suffix' => null,
                'gender' => null,
                'store_id' => null,
                'taxvat' => null,
                'website_id' => null,
                'extension_attributes' => [],
                'custom_attributes' => []
            ],
        ], $command->toJson());
    }

    public function testAccessor()
    {
        $command = SaveCustomerCommand::of(CustomerData::of('test@amp.co'));
        self::assertTrue((CustomerData::of('test@amp.co'))->equals($command->getCustomerData()));
    }
}
