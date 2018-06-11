<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\CustomerAddress;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\RegionData;

class CustomerAddressTest extends TestCase
{
    public function testToJson()
    {
        self::assertEquals([
            'id' => 1,
            'custom_attributes' => [],
            'default_shipping' => 0,
            'default_billing' => 0,
            'region' => null,
            'city' => null,
            'company' => null,
            'country_id' => null,
            'customer_id' => null,
            'fax' => null,
            'firstname' => null,
            'lastname' => null,
            'middlename' => null,
            'postcode' => null,
            'prefix' => null,
            'region_id' => 0,
            'street' => null,
            'suffix' => null,
            'telephone' => null,
            'vat_id' => null,
            'extension_attributes' => []
        ], CustomerAddress::create()->withId(1)->toJson());
    }

    public function testFromJson()
    {
        $json = [
            'id' => 1,
            'custom_attributes' => [
                ['attribute_code' => 'test', 'value' => 1]
            ],
            'default_shipping' => 2,
            'default_billing' => 1,
            'region' => [
                'region_id' => 0,
                'region_code' => 'regioncode',
                'region' => 'test',
            ],
            'city' => 'Manchester',
            'company' => 'company name',
            'country_id' => 'uk',
            'customer_id' => null,
            'fax' => '222222222',
            'firstname' => 'First',
            'lastname' => 'Last',
            'middlename' => 'Middle',
            'postcode' => 'M4 7FD',
            'prefix' => 'Mr',
            'region_id' => 7,
            'street' => ['First line', 'Second line'],
            'suffix' => 'suffix',
            'telephone' => '99999999',
            'vat_id' => '1',
            'extension_attributes' => [
                'test' => 2
            ]
        ];
        self::assertEquals($json, CustomerAddress::fromJson($json)->toJson());
    }

    public function testWithers()
    {
        $this->getData();

        self::assertEquals($this->getData()->toJson(), [
            'id' => 1,
            'custom_attributes' => [
                ['attribute_code' => 'test', 'value' => 1]
            ],
            'default_shipping' => 2,
            'default_billing' => 1,
            'region' => [
                'region_id' => 0,
                'region_code' => 'regioncode',
                'region' => 'test',
            ],
            'city' => 'Manchester',
            'company' => 'company name',
            'country_id' => 'uk',
            'customer_id' => null,
            'fax' => '222222222',
            'firstname' => 'First',
            'lastname' => 'Last',
            'middlename' => 'Middle',
            'postcode' => 'M4 7FD',
            'prefix' => 'Mr',
            'region_id' => 7,
            'street' => ['First line', 'Second line'],
            'suffix' => 'suffix',
            'telephone' => '99999999',
            'vat_id' => '1',
            'extension_attributes' => [
                'test' => 2
            ]
        ]);
    }

    public function testEqualsSimple()
    {
        $address1 = $this->getData();
        $address2 = $this->getData();

        self::assertTrue($address1->equals($address2));
        self::assertFalse($address1->equals($address2->withFirstname('test')));
    }

    public function testGetters()
    {
        $address = $this->getData();

        self::assertEquals([
            'id' => $address->getId(),
            'custom_attributes' => $address->getCustomAttributes()->toJson(),
            'default_shipping' => $address->getDefaultShipping(),
            'default_billing' => $address->getDefaultBilling(),
            'region' => [
                'region_id' => $address->getRegion()->getRegionId(),
                'region_code' => $address->getRegion()->getRegionCode(),
                'region' => $address->getRegion()->getRegion(),
            ],
            'city' => $address->getCity(),
            'company' => $address->getCompany(),
            'country_id' => $address->getCountryId(),
            'customer_id' => $address->getCustomerId(),
            'fax' => $address->getFax(),
            'firstname' => $address->getFirstname(),
            'lastname' => $address->getLastname(),
            'middlename' => $address->getMiddlename(),
            'postcode' => $address->getPostcode(),
            'prefix' => $address->getPrefix(),
            'region_id' => $address->getRegionId(),
            'street' => $address->getStreet(),
            'suffix' => $address->getSuffix(),
            'telephone' => $address->getTelephone(),
            'vat_id' => $address->getVatId(),
            'extension_attributes' => $address->getExtensionAttributes()->toJson()
        ], $address->toJson());
    }

    private function getData(): CustomerAddress
    {
        return CustomerAddress::create()
            ->withId(1)
            ->withDefaultBilling(1)
            ->withDefaultShipping(2)
            ->withCity('Manchester')
            ->withFirstname('First')
            ->withLastname('Last')
            ->withMiddlename('Middle')
            ->withCompany('company name')
            ->withCountryId('uk')
            ->withPrefix('Mr')
            ->withSuffix('suffix')
            ->withTelephone('99999999')
            ->withFax('222222222')
            ->withPostcode('M4 7FD')
            ->withStreet(['First line', 'Second line'])
            ->withRegionId(7)
            ->withVatId(1)
            ->withCustomAttributes(
                CustomAttributeSet::of([
                    CustomAttribute::of('test', 1)
                ])
            )
            ->withRegion(
                RegionData::of('regioncode')
                    ->withRegion('test')
                    ->withRegionId(0))
            ->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of('test', 2)
                ])
            );
    }
}

