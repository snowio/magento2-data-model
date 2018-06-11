<?php

namespace SnowIO\Magento2DataModel;

class CustomerAddress
{
    public static function create(): self
    {
        return new self;
    }

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->id = $json['id'];
        $result->city = $json['city'];
        $result->company = $json['company'] ?? null;
        $result->countryId = $json['country_id'] ?? null;
        $result->customerId = $json['customer_id'] ?? null;
        $result->defaultBilling = $json['default_billing'] ?? null;
        $result->defaultShipping = $json['default_shipping'] ?? null;
        $result->fax = $json['fax'] ?? null;
        $result->firstname = $json['firstname'];
        $result->lastname = $json['lastname'];
        $result->middlename = $json['middlename'] ?? null;
        $result->postcode = $json['postcode'];
        $result->prefix = $json['prefix'] ?? null;
        $result->region = $json['region'] ?? null;
        $result->regionId = $json['region_id'] ?? null;
        $result->street = $json['street'] ?? [] ?? null;
        $result->suffix = $json['suffix'] ?? null;
        $result->telephone = $json['telephone'];
        $result->vatId = $json['vat_id'] ?? null;

        if ($json['region']) {
            $result->region = RegionData::fromJson($json['region']);
        }

        if ($json['extension_attributes']) {
            $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes']);
        }

        if ($json['custom_attributes']) {
            $result->customAttributes = CustomAttributeSet::fromJson($json['custom_attributes']);
        }

        return $result;
    }

    public function equals($other): bool
    {
        return $other instanceof self
        && $this->id === $other->id
        && $this->city === $other->city
        && $this->company === $other->company
        && $this->countryId === $other->countryId
        && $this->customerId === $other->customerId
        && $this->defaultBilling === $other->defaultBilling
        && $this->defaultShipping === $other->defaultShipping
        && $this->fax === $other->fax
        && $this->firstname === $other->firstname
        && $this->lastname === $other->lastname
        && $this->middlename === $other->middlename
        && $this->postcode === $other->postcode
        && $this->prefix === $other->prefix
        && $this->regionId === $other->regionId
        && $this->street === $other->street
        && $this->suffix === $other->suffix
        && $this->telephone === $other->telephone
        && $this->vatId === $other->vatId
        && (($this->region !== null && $other->region) && $this->region->equals($other->region))
        && $this->customAttributes->equals($other->customAttributes);
    }

    public function toJson(): array
    {
        return [
            "id" => $this->id,
            "city" => $this->city,
            "company" => $this->company,
            "country_id" => $this->countryId,
            "customer_id" => $this->customerId,
            "fax" => $this->fax,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "middlename" => $this->middlename,
            "postcode" => $this->postcode,
            "prefix" => $this->prefix,
            "region_id" => (int) $this->regionId,
            "street" => $this->street,
            "suffix" => $this->suffix,
            "telephone" => $this->telephone,
            "vat_id" => $this->vatId,
            "default_shipping" => (int) $this->defaultShipping,
            "default_billing" => (int) $this->defaultBilling,
            "region" => ($this->region) ? $this->region->toJson() : null,
            "custom_attributes" => $this->customAttributes->toJson(),
            "extension_attributes" => $this->extensionAttributes->toJson()
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function withId(int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getDefaultShipping(): ?int
    {
        return $this->defaultShipping;
    }

    public function withDefaultShipping($defaultShipping): self
    {
        $result = clone $this;
        $result->defaultShipping = $defaultShipping;
        return $result;
    }

    public function getDefaultBilling(): ?int
    {
        return $this->defaultBilling;
    }

    public function withDefaultBilling(int $defaultBilling): self
    {
        $result = clone $this;
        $result->defaultBilling = $defaultBilling;
        return $result;
    }

    public function getRegion(): ?RegionData
    {
        return $this->region;
    }

    public function withRegion(RegionData $region): self
    {
        $result = clone $this;
        $result->region = $region;
        return $result;
    }

    public function getCustomAttributes(): CustomAttributeSet
    {
        return $this->customAttributes;
    }

    public function withCustomAttribute(CustomAttribute $customAttribute): self
    {
        $result = clone $this;
        $result->customAttributes = $result->customAttributes
            ->withCustomAttribute($customAttribute);
        return $result;
    }

    public function withCustomAttributes(CustomAttributeSet $customAttributes): self
    {
        $result = clone $this;
        $result->customAttributes = $customAttributes;
        return $result;
    }

    public function getCity() : ?string
    {
        return $this->city;
    }

    public function withCity(string $city): self
    {
        $result = clone $this;
        $result->city = $city;
        return $result;
    }

    public function getCompany() : ?string
    {
        return $this->company;
    }

    public function withCompany(string $company): self
    {
        $result = clone $this;
        $result->company = $company;
        return $result;
    }

    public function getCountryId() : ?string
    {
        return $this->countryId;
    }

    public function withCountryId(string $countryId): self
    {
        $result = clone $this;
        $result->countryId = $countryId;
        return $result;
    }

    public function getCustomerId() : ?int
    {
        return $this->customerId;
    }

    public function withCustomerId(int $customerId): self
    {
        $result = clone $this;
        $result->customerId = $customerId;
        return $result;
    }

    public function getFax() : ?string
    {
        return $this->fax;
    }

    public function withFax(string $fax): self
    {
        $result = clone $this;
        $result->fax = $fax;
        return $result;
    }

    public function getFirstname() : ?string
    {
        return $this->firstname;
    }

    public function withFirstname(string $firstname): self
    {
        $result = clone $this;
        $result->firstname = $firstname;
        return $result;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function withLastname(string $lastname): self
    {
        $result = clone $this;
        $result->lastname = $lastname;
        return $result;
    }

    public function getMiddlename() : ?string
    {
        return $this->middlename;
    }

    public function withMiddlename(string $middlename): self
    {
        $result = clone $this;
        $result->middlename = $middlename;
        return $result;
    }

    public function getPostcode() : string
    {
        return $this->postcode;
    }

    public function withPostcode(string $postcode): self
    {
        $result = clone $this;
        $result->postcode = $postcode;
        return $result;
    }

    public function getPrefix() : ?string
    {
        return $this->prefix;
    }

    public function withPrefix(string $prefix): self
    {
        $result = clone $this;
        $result->prefix = $prefix;
        return $result;
    }

    public function getRegionId() : ?int
    {
        return $this->regionId;
    }

    public function withRegionId(int $regionId): self
    {
        $result = clone $this;
        $result->regionId = $regionId;
        return $result;
    }

    public function getStreet() : array
    {
        return $this->street;
    }

    public function withStreet(array $street): self
    {
        $result = clone $this;
        $result->street = $street;
        return $result;
    }

    public function getSuffix() : ?string
    {
        return $this->suffix;
    }

    public function withSuffix(string $suffix): self
    {
        $result = clone $this;
        $result->suffix = $suffix;
        return $result;
    }

    public function getVatId() : ?string
    {
        return $this->vatId;
    }

    public function withVatId(string $vatId): self
    {
        $result = clone $this;
        $result->vatId = $vatId;
        return $result;
    }

    public function getTelephone() : ?string
    {
        return $this->telephone;
    }

    public function withTelephone(string $telephone): self
    {
        $result = clone $this;
        $result->telephone = $telephone;
        return $result;
    }

    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withExtensionAttribute(ExtensionAttribute $extensionAttribute): self
    {
        $result = clone $this;
        $result->extensionAttributes = $result->extensionAttributes
            ->withExtensionAttribute($extensionAttribute);
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    protected function __construct()
    {
        $this->extensionAttributes = ExtensionAttributeSet::create();
        $this->customAttributes = CustomAttributeSet::create();
    }

    private $id;
    private $defaultShipping;
    private $defaultBilling;
    private $company;
    private $city;
    private $countryId;
    private $customerId;
    private $fax;
    private $firstname;
    private $lastname;
    private $middlename;
    private $telephone;
    private $regionId;
    private $street;
    private $postcode;
    private $prefix;
    private $suffix;
    private $vatId;
    /** @var RegionData|null */
    private $region;
    /** @var CustomAttributeSet */
    private $customAttributes;
    /** @var ExtensionAttributeSet */
    protected $extensionAttributes;
}