<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\AddressData;
use SnowIO\Magento2DataModel\Order\ItemData;

class AddressDataTest extends TestCase
{
    public function testToJson()
    {
        $address = self::getAddress();
        self::assertEquals(self::getAddressJson(), $address->toJson());
    }

    public function testFromJson()
    {
        $address = AddressData::fromJson(self::getAddressJson());
        self::assertEquals("string", $address->getAddressType());
        self::assertEquals("string", $address->getCity());
        self::assertEquals("string", $address->getCompany());
        self::assertEquals("string", $address->getCountryId());
        self::assertEquals("0", $address->getCustomerAddressId());
        self::assertEquals("0", $address->getCustomerId());
        self::assertEquals("string", $address->getEmail());
        self::assertEquals("0", $address->getEntityId());
        self::assertEquals("string", $address->getFax());
        self::assertEquals("string", $address->getFirstname());
        self::assertEquals("string", $address->getLastname());
        self::assertEquals("string", $address->getMiddlename());
        self::assertEquals("0", $address->getParentId());
        self::assertEquals("string", $address->getPostcode());
        self::assertEquals("string", $address->getPrefix());
        self::assertEquals("string", $address->getRegion());
        self::assertEquals("string", $address->getRegionCode());
        self::assertEquals("0", $address->getRegionId());
        self::assertEquals(["string"], $address->getStreet());
        self::assertEquals("string", $address->getSuffix());
        self::assertEquals("string", $address->getTelephone());
        self::assertEquals("string", $address->getVatId());
        self::assertEquals(0, $address->getVatIsValid());
        self::assertEquals("string", $address->getVatRequestDate());
        self::assertEquals("string", $address->getVatRequestId());
        self::assertEquals(0, $address->getVatRequestSuccess());
        self::assertTrue(ExtensionAttributeSet::create()->equals($address->getExtensionAttributes()));
        self::assertTrue(self::getAddress()->equals($address));
    }

    public function testEquals()
    {
        $address = self::getAddress();
        $otherAddress = self::getAddress();
        self::assertTrue($address->equals($otherAddress));
        self::assertFalse(($otherAddress->withCity('Nairobi'))->equals($address));
        self::assertFalse($address->equals(ItemData::of('1234')));
    }

    public static function getAddressJson(): array
    {
        return [
            "address_type" => "string",
            "city" => "string",
            "company" => "string",
            "country_id" => "string",
            "customer_address_id" => 0,
            "customer_id" => 0,
            "email" => "string",
            "entity_id" => 0,
            "fax" => "string",
            "firstname" => "string",
            "lastname" => "string",
            "middlename" => "string",
            "parent_id" => 0,
            "postcode" => "string",
            "prefix" => "string",
            "region" => "string",
            "region_code" => "string",
            "region_id" => 0,
            "street" => [
                "string"
            ],
            "suffix" => "string",
            "telephone" => "string",
            "vat_id" => "string",
            "vat_is_valid" => 0,
            "vat_request_date" => "string",
            "vat_request_id" => "string",
            "vat_request_success" => 0,
            "extension_attributes" => [],
        ];
    }

    public static function getAddress(): AddressData
    {
        return AddressData::create()
            ->withAddressType("string")
            ->withCity("string")
            ->withCompany("string")
            ->withCountryId("string")
            ->withCustomerAddressId("0")
            ->withCustomerId("0")
            ->withEmail("string")
            ->withEntityId("0")
            ->withFax("string")
            ->withFirstname("string")
            ->withLastname("string")
            ->withMiddlename("string")
            ->withParentId("0")
            ->withPostcode("string")
            ->withPrefix("string")
            ->withRegion("string")
            ->withRegionCode("string")
            ->withRegionId("0")
            ->withStreet(['string'])
            ->withSuffix("string")
            ->withTelephone("string")
            ->withVatId("string")
            ->withVatIsValid(0)
            ->withVatRequestDate("string")
            ->withVatRequestId("string")
            ->withVatRequestSuccess(0);
    }
}
