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
        $command = SaveCustomerCommand::of(CustomerData::of('test@amp.co')->withId(1))
        ->withTimestamp(1509530316);
        self::assertEquals([
            '@timestamp' => (float)1509530316,
            'customerId' => 1,
            'customer' => [
                'id' => 1,
                'email' => 'test@amp.co',
                'firstname' => null,
                'lastname' => null,
                'group_id' => null,
                'default_billing' => null,
                'default_shipping' => null,
                'confirmation' => null,
                'created_at' => null,
                'updated_at' => null,
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

    public function testCustomerIdFromCommandPayload()
    {
        $command = SaveCustomerCommand::of(
            CustomerData::of('test@amp.co')->withId(99)
        )->withTimestamp(1509530316);

        self::assertArraySubset(['customerId' => 99], $command->toJson());
    }

    public function testGetCustomerDataAccessor()
    {
        $command = SaveCustomerCommand::of(CustomerData::of('test@amp.co'));
        self::assertTrue((CustomerData::of('test@amp.co'))->equals($command->getCustomerData()));
    }

    public function testEquals()
    {
        $command1 = SaveCustomerCommand::of(CustomerData::of('test@amp.co'));
        $command2 = SaveCustomerCommand::of(CustomerData::of('test@amp.co'));
        self::assertTrue($command1->equals($command2));
    }
}
