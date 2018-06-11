<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AddressSet;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\CustomerAddress;
use SnowIO\Magento2DataModel\CustomerData;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\RegionData;

class CustomerDataTest extends TestCase
{
    public function testToJson()
    {
        self::assertSame([
            'id' => 0,
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
            ->withCreatedAt('2018-01-01 10:00:00')
            ->withUpdatedAt('2018-01-01 10:00:00')
            ->withCreatedIn('StoreName')
            ->withConfirmation('something')
            ->withTaxVAT('x')
            ->withFirstname('first')
            ->withLastname('last')
            ->withMiddlename('middle')
            ->withDateOfBirth('1985-04-03')
            ->withAddresses(
                AddressSet::create()->withAddress(
                    CustomerAddress::create()
                        ->withId(1)
                        ->withCity('Manchester')
                        ->withFirstname('Firstname')
                        ->withLastname('Lastname')
                        ->withCompany('company name')
                        ->withCountryId(1)
                        ->withPrefix('Mr')
                )
            )
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

        self::assertEquals($customer->toJson(), [
            'id' => 1,
            'email' => 'test@amp.co',
            'firstname' => 'first',
            'lastname' => 'last',
            'group_id' => 1,
            'default_billing' => null,
            'default_shipping' => null,
            'confirmation' => 'something',
            'created_at' => '2018-01-01 10:00:00',
            'updated_at' => '2018-01-01 10:00:00',
            'created_in' => 'StoreName',
            'dob' => '1985-04-03',
            'middlename' => 'middle',
            'prefix' => 'Mr',
            'suffix' => 'suffix',
            'gender' => '1',
            'store_id' => 1,
            'taxvat' => 'x',
            'website_id' => 1,
            'addresses' => [
                [
                    'id' => 1,
                    'custom_attributes' => [],
                    'extension_attributes' => [],
                    'default_shipping' => 0,
                    'default_billing' => 0,
                    'region' => null,
                    'city' => 'Manchester',
                    'company' => 'company name',
                    'country_id' => '1',
                    'customer_id' => null,
                    'fax' => null,
                    'firstname' => 'Firstname',
                    'lastname' => 'Lastname',
                    'middlename' => null,
                    'postcode' => null,
                    'prefix' => 'Mr',
                    'region_id' => 0,
                    'street' => null,
                    'suffix' => null,
                    'telephone' => null,
                    'vat_id' => null
                ]
            ],
            'extension_attributes' => [
                'test' => 2
            ],
            'custom_attributes' => [
                ['attribute_code' => 'test', 'value' => 1]
            ]
        ]);
    }

    public function testCustomerAddressWithers()
    {
        $customer = CustomerData::of('test@amp.co')
            ->withId(1)
            ->withStoreId(1)
            ->withWebsiteId(1)
            ->withGroupId(1)
            ->withPrefix('Mr')
            ->withSuffix('suffix')
            ->withGender('1')
            ->withCreatedAt('2018-01-01 10:00:00')
            ->withUpdatedAt('2018-01-01 10:00:00')
            ->withCreatedIn('StoreName')
            ->withConfirmation('something')
            ->withTaxVAT('x')
            ->withFirstname('first')
            ->withLastname('last')
            ->withMiddlename('middle')
            ->withDateOfBirth('1985-04-03')
            ->withAddresses(
                AddressSet::create()->withAddress(
                        CustomerAddress::create()
                            ->withId(1)
                            ->withCustomerId(3)
                            ->withCity('Manchester')
                            ->withFirstname('Firstname')
                            ->withLastname('Lastname')
                            ->withCompany('company name')
                            ->withCountryId('uk')
                            ->withStreet(['line1', 'line2', 'line3'])
                            ->withPostcode('M4 7DS')
                            ->withPrefix('Mr')
                            ->withSuffix('s')
                            ->withTelephone('3333')
                            ->withFax('999')
                            ->withVatId(3)
                            ->withRegion(
                                RegionData::of('uk')
                                    ->withRegion('region')
                                    ->withRegionCode('code')
                            )
                )
            );

        self::assertEquals($customer->toJson(), [
            'id' => 1,
            'email' => 'test@amp.co',
            'firstname' => 'first',
            'lastname' => 'last',
            'group_id' => 1,
            'default_billing' => null,
            'default_shipping' => null,
            'confirmation' => 'something',
            'created_at' => '2018-01-01 10:00:00',
            'updated_at' => '2018-01-01 10:00:00',
            'created_in' => 'StoreName',
            'dob' => '1985-04-03',
            'middlename' => 'middle',
            'prefix' => 'Mr',
            'suffix' => 'suffix',
            'gender' => '1',
            'store_id' => 1,
            'taxvat' => 'x',
            'website_id' => 1,
            'extension_attributes' => [],
            'custom_attributes' => [],
            'addresses' => [
                [
                    'id' => 1,
                    'custom_attributes' => [],
                    'default_shipping' => 0,
                    'default_billing' => 0,
                    'region' => [
                        'region_id' => 0,
                        'region_code' => 'code',
                        'region' => 'region',
                    ],
                    'city' => 'Manchester',
                    'company' => 'company name',
                    'country_id' => 'uk',
                    'customer_id' => 3,
                    'fax' => '999',
                    'firstname' => 'Firstname',
                    'lastname' => 'Lastname',
                    'middlename' => null,
                    'postcode' => 'M4 7DS',
                    'prefix' => 'Mr',
                    'region_id' => 0,
                    'street' => ['line1','line2','line3'],
                    'suffix' => 's',
                    'telephone' => '3333',
                    'vat_id' => '3',
                    'extension_attributes' => []
                ]
            ]
        ]);
    }

    public function testEqualsSimple()
    {
        $customer = CustomerData::of('test@amp.co');

        self::assertTrue($customer->equals(CustomerData::of('test@amp.co')));
        self::assertFalse($customer->equals(CustomerData::of('test2@amp.co')));
    }

    public function testGetters()
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
            ->withAddresses(
                AddressSet::create()->withAddress(
                    CustomerAddress::create()
                        ->withId(1)
                        ->withCustomerId(3)
                        ->withCity('Manchester')
                        ->withFirstname('Firstname')
                        ->withLastname('Lastname')
                        ->withCompany('company name')
                        ->withCountryId('uk')
                        ->withStreet(['line1', 'line2', 'line3'])
                        ->withPostcode('M4 7DS')
                        ->withPrefix('Mr')
                        ->withSuffix('s')
                        ->withTelephone('3333')
                        ->withFax('999')
                        ->withVatId(3)
                        ->withRegion(
                            RegionData::of('uk')
                                ->withRegion('region')
                                ->withRegionCode('code')
                        )
                )
            )
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

        self::assertEquals([
            'id' => $customer->getId(),
            'email' => $customer->getEmail(),
            'firstname' => $customer->getFirstname(),
            'lastname' => $customer->getLastname(),
            'group_id' => $customer->getGroupId(),
            'default_billing' => null,
            'default_shipping' => null,
            'confirmation' => $customer->getConfirmation(),
            'created_at' => $customer->getCreatedAt(),
            'updated_at' => $customer->getUpdatedAt(),
            'created_in' => $customer->getCreatedIn(),
            'dob' => $customer->getDateOfBirth(),
            'middlename' => $customer->getMiddlename(),
            'prefix' => $customer->getPrefix(),
            'suffix' => $customer->getSuffix(),
            'gender' => $customer->getGender(),
            'store_id' => $customer->getStoreId(),
            'taxvat' => $customer->getTaxVAT(),
            'website_id' => $customer->getWebsiteId(),
            'addresses' => $customer->getAddresses()->toJson(),
            'extension_attributes' => $customer->getExtensionAttributes()->toJson(),
            'custom_attributes' => $customer->getCustomAttributes()->toJson()
        ], $customer->toJson());
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
            ->withAddresses(
                AddressSet::create()->withAddress(
                CustomerAddress::create()
                    ->withId(1)
                    ->withCity('Manchester')
                    ->withFirstname('Firstname')
                    ->withLastname('Lastname')
                    ->withCompany('company name')
                    ->withCountryId(1)
                    ->withPrefix('Mr')
                )
            )
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

        self::assertTrue($customer->equals($customer2));

        $customer2 = $customer2->withStoreId(2);

        self::assertFalse($customer->equals($customer2));
    }
}

