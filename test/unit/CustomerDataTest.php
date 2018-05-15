<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\CustomerData;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

class CustomerDataTest extends TestCase
{
    public function testToJson()
    {
        self::assertSame([
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
        ], CustomerData::of('test@amp.co')->toJson());
    }

    public function testWithers()
    {
        $customer = CustomerData::of('test@amp.co')
            ->withId(1)
            ->withStoreId(1)
            ->withWebsiteId(1)
            ->withGroupId(1)
            ->withPrefix('Mr')
            ->withSuffix('suffix')
            ->withGender('1')
            ->withConfirmation('something')
            ->withTaxVAT('x')
            ->withFirstname('first')
            ->withLastname('last')
            ->withMiddlename('middle')
            ->withDateOfBirth('1985-04-03')
            ->withAddress('some address')
            ->withCustomAttributes(
                CustomAttributeSet::of([
                    CustomAttribute::of('test', 1)
                ])
            )
            ->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of('test', 2)
                ])
            );

        self::assertSame($customer->toJson(), [
            'id' => 1,
            'email' => 'test@amp.co',
            'firstname' => 'first',
            'lastname' => 'last',
            'group_id' => 1,
            'default_billing' => null,
            'default_shipping' => null,
            'confirmation' => 'something',
            'created_in' => null,
            'dob' => null,
            'middlename' => 'middle',
            'prefix' => 'Mr',
            'suffix' => 'suffix',
            'gender' => '1',
            'store_id' => 1,
            'taxvat' => 'x',
            'website_id' => 1,
            'extension_attributes' => [
                'test' => 2
            ],
            'custom_attributes' => [
                ['attribute_code' => 'test', 'value' => 1]
            ]
        ]);
    }

    public function testEqualsSimple()
    {
        $customer = CustomerData::of('test@amp.co');

        self::assertTrue($customer->equals(CustomerData::of('test@amp.co')));
        self::assertFalse($customer->equals(CustomerData::of('test2@amp.co')));
    }

    public function testEqualsComplete()
    {
        $customer = CustomerData::of('test@amp.co')
            ->withId(1)
            ->withStoreId(1)
            ->withWebsiteId(1)
            ->withGroupId(1)
            ->withPrefix('Mr')
            ->withSuffix('suffix')
            ->withGender('1')
            ->withConfirmation('something')
            ->withTaxVAT('x')
            ->withFirstname('first')
            ->withLastname('last')
            ->withMiddlename('middle')
            ->withDateOfBirth('1985-04-03')
            ->withAddress('some address')
            ->withCustomAttributes(
                CustomAttributeSet::of([
                    CustomAttribute::of('test', 1)
                ])
            )
            ->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of('test', 2)
                ])
            );

        // lets change just 1 value
        $customer2 = clone $customer;
        $customer2 = $customer2->withStoreId(1);

        self::assertTrue($customer->equals($customer2));
    }
}

