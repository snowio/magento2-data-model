<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class AddressData implements ValueObject
{
    public static function create()
    {
        return new self;
    }

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->addressType = $json['address_type'] ?? null;
        $result->city = $json['city'] ?? null;
        $result->company = $json['company'] ?? null;
        $result->countryId = (string) $json['country_id'] ?? null;
        $result->customerAddressId = (string) $json['customer_address_id'] ?? null;
        $result->customerId = (string) $json['customer_id'] ?? null;
        $result->email = $json['email'] ?? null;
        $result->entityId = (string) $json['entity_id'] ?? null;
        $result->fax = $json['fax'] ?? null;
        $result->firstname = $json['firstname'] ?? null;
        $result->lastname = $json['lastname'] ?? null;
        $result->middlename = $json['middlename'] ?? null;
        $result->parentId = (string) $json['parent_id'] ?? null;
        $result->postcode = $json['postcode'] ?? null;
        $result->prefix = $json['prefix'] ?? null;
        $result->region = $json['region'] ?? null;
        $result->regionCode = $json['region_code'] ?? null;
        $result->regionId = (string) $json['region_id'] ?? null;
        $result->street = $json['street'] ?? [];
        $result->suffix = $json['suffix'] ?? null;
        $result->telephone = $json['telephone'] ?? null;
        $result->vatId = (string) $json['vat_id'] ?? null;
        $result->vatIsValid = $json['vat_is_valid'] ?? null;
        $result->vatRequestDate = $json['vat_request_date'] ?? null;
        $result->vatRequestId = (string) $json['vat_request_id'] ?? null;
        $result->vatRequestSuccess = $json['vat_request_success'] ?? null;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    public function getAddressType() : ?string
    {
        return $this->addressType;
    }

    public function getCity() : ?string
    {
        return $this->city;
    }

    public function getCompany() : ?string
    {
        return $this->company;
    }

    public function getCountryId() : ?string
    {
        return $this->countryId;
    }

    public function getCustomerAddressId(): ?string
    {
        return $this->customerAddressId;
    }

    public function getCustomerId() : ?string
    {
        return $this->customerId;
    }

    public function getEmail() :  ?string
    {
        return $this->email;
    }

    public function getEntityId() : ?string
    {
        return $this->entityId;
    }

    public function getFax() : ?string
    {
        return $this->fax;
    }

    public function getFirstname() : ?string
    {
        return $this->firstname;
    }

    public function getLastname() : ?string
    {
        return $this->lastname;
    }

    public function getMiddlename() : ?string
    {
        return $this->middlename;
    }

    public function getParentId() : ?string
    {
        return $this->parentId;
    }

    public function getPostcode() : ?string
    {
        return $this->postcode;
    }

    public function getPrefix() : ?string
    {
        return $this->prefix;
    }

    public function getRegion() : ?string
    {
        return $this->region;
    }

    public function getRegionCode() : ?string
    {
        return $this->regionCode;
    }

    public function getRegionId() : ?string
    {
        return $this->regionId;
    }

    public function getStreet() : array
    {
        return $this->street;
    }

    public function getSuffix() : ?string
    {
        return $this->suffix;
    }

    public function getTelephone() : ?string
    {
        return $this->telephone;
    }

    public function getVatId() : ?string
    {
        return $this->vatId;
    }

    public function getVatIsValid() : ?int
    {
        return $this->vatIsValid;
    }

    public function getVatRequestDate() : ?string
    {
        return $this->vatRequestDate;
    }

    public function getVatRequestId() : ?string
    {
        return $this->vatRequestId;
    }

    public function getVatRequestSuccess() : ?int
    {
        return $this->vatRequestSuccess;
    }


    public function getExtensionAttributes() : ?ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withAddressType(string $addressType) : self
    {
        $result = clone $this;
        $result->addressType = $addressType;
        return $result;
    }

    public function withCity(string $city): self
    {
        $result = clone $this;
        $result->city = $city;
        return $result;
    }

    public function withCompany(string $company): self
    {
        $result = clone $this;
        $result->company = $company;
        return $result;
    }

    public function withCountryId(string $countryId): self
    {
        $result = clone $this;
        $result->countryId = $countryId;
        return $result;
    }

    public function withCustomerAddressId(string $customerAddressId): self
    {
        $result = clone $this;
        $result->customerAddressId = $customerAddressId;
        return $result;
    }

    public function withCustomerId(string $customerId): self
    {
        $result = clone $this;
        $result->customerId = $customerId;
        return $result;
    }

    public function withEmail(string $email): self
    {
        $result = clone $this;
        $result->email = $email;
        return $result;
    }

    public function withEntityId(string $entityId): self
    {
        $result = clone $this;
        $result->entityId = $entityId;
        return $result;
    }

    public function withFax(string $fax): self
    {
        $result = clone $this;
        $result->fax = $fax;
        return $result;
    }

    public function withFirstname(string $firstname): self
    {
        $result = clone $this;
        $result->firstname = $firstname;
        return $result;
    }

    public function withLastname(string $lastname): self
    {
        $result = clone $this;
        $result->lastname = $lastname;
        return $result;
    }

    public function withMiddlename(string $middlename): self
    {
        $result = clone $this;
        $result->middlename = $middlename;
        return $result;
    }

    public function withParentId(string $parentId): self
    {
        $result = clone $this;
        $result->parentId = $parentId;
        return $result;
    }

    public function withPostcode(string $postcode): self
    {
        $result = clone $this;
        $result->postcode = $postcode;
        return $result;
    }

    public function withPrefix(string $prefix): self
    {
        $result = clone $this;
        $result->prefix = $prefix;
        return $result;
    }

    public function withRegion(string $region): self
    {
        $result = clone $this;
        $result->region = $region;
        return $result;
    }

    public function withRegionCode(string $regionCode): self
    {
        $result = clone $this;
        $result->regionCode = $regionCode;
        return $result;
    }

    public function withRegionId(string $regionId): self
    {
        $result = clone $this;
        $result->regionId = $regionId;
        return $result;
    }

    public function withStreet(array $street): self
    {
        $result = clone $this;
        $result->street = $street;
        return $result;
    }

    public function withSuffix(string $suffix): self
    {
        $result = clone $this;
        $result->suffix = $suffix;
        return $result;
    }

    public function withTelephone(string $telephone): self
    {
        $result = clone $this;
        $result->telephone = $telephone;
        return $result;
    }

    public function withVatId(string $vatId): self
    {
        $result = clone $this;
        $result->vatId = $vatId;
        return $result;
    }

    public function withVatIsValid(int $vatIsValid): self
    {
        $result = clone $this;
        $result->vatIsValid = $vatIsValid;
        return $result;
    }

    public function withVatRequestDate(string $vatRequestDate): self
    {
        $result = clone $this;
        $result->vatRequestDate = $vatRequestDate;
        return $result;
    }

    public function withVatRequestId(string $vatRequestId): self
    {
        $result = clone $this;
        $result->vatRequestId = $vatRequestId;
        return $result;
    }

    public function withVatRequestSuccess(int $vatRequestSuccess): self
    {
        $result = clone $this;
        $result->vatRequestSuccess = $vatRequestSuccess;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }


    public function toJson(): array
    {
        return [
            "address_type" => $this->addressType,
            "city" => $this->city,
            "company" => $this->company,
            "country_id" => $this->countryId,
            "customer_address_id" => $this->customerAddressId,
            "customer_id" => $this->customerId,
            "email" => $this->email,
            "entity_id" => $this->entityId,
            "fax" => $this->fax,
            "firstname" => $this->lastname,
            "lastname" => $this->lastname,
            "middlename" => $this->middlename,
            "parent_id" => $this->parentId,
            "postcode" => $this->postcode,
            "prefix" => $this->prefix,
            "region" => $this->region,
            "region_code" => $this->regionCode,
            "region_id" => $this->regionId,
            "street" => $this->street,
            "suffix" => $this->suffix,
            "telephone" => $this->telephone,
            "vat_id" => $this->vatId,
            "vat_is_valid" => $this->vatIsValid,
            "vat_request_date" => $this->vatRequestDate,
            "vat_request_id" => $this->vatRequestId,
            "vat_request_success" => $this->vatRequestSuccess,
            "extension_attributes" => $this->extensionAttributes->toJson(),
        ];
    }

    private function __construct()
    {
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }


    private $addressType;
    private $city;
    private $company;
    private $countryId;
    private $customerAddressId;
    private $customerId;
    private $email;
    private $entityId;
    private $fax;
    private $firstname;
    private $lastname;
    private $middlename;
    private $parentId;
    private $postcode;
    private $prefix;
    private $region;
    private $regionCode;
    private $regionId;
    private $street;
    private $suffix;
    private $telephone;
    private $vatId;
    private $vatIsValid;
    private $vatRequestDate;
    private $vatRequestId;
    private $vatRequestSuccess;
    private $extensionAttributes;

    public function equals($other): bool
    {
        return $other instanceof self
        && $this->addressType === $other->addressType
        && $this->city === $other->city
        && $this->company === $other->company
        && $this->countryId === $other->countryId
        && $this->customerAddressId === $other->customerAddressId
        && $this->customerId === $other->customerId
        && $this->email === $other->email
        && $this->entityId === $other->entityId
        && $this->fax === $other->fax
        && $this->firstname === $other->firstname
        && $this->lastname === $other->lastname
        && $this->middlename === $other->middlename
        && $this->parentId === $other->parentId
        && $this->postcode === $other->postcode
        && $this->prefix === $other->prefix
        && $this->region === $other->region
        && $this->regionCode === $other->regionCode
        && $this->regionId === $other->regionId
        && $this->street === $other->street
        && $this->suffix === $other->suffix
        && $this->telephone === $other->telephone
        && $this->vatId === $other->vatId
        && $this->vatIsValid === $other->vatIsValid
        && $this->vatRequestDate === $other->vatRequestDate
        && $this->vatRequestId === $other->vatRequestId
        && $this->vatRequestSuccess === $other->vatRequestSuccess
        && $this->extensionAttributes->equals($other->extensionAttributes);
    }
}
