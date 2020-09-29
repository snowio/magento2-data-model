<?php

namespace SnowIO\Magento2DataModel;

final class CustomerData implements ValueObject
{
    use EavEntityTrait;

    private $customAttributes;
    private $extensionAttributes;
    private $email;
    private $firstname;
    private $lastname;
    private $id;
    private $storeId;
    private $middlename;
    private $websiteId;
    private $groupId;
    private $prefix;
    private $gender;
    private $suffix;
    private $taxVAT;
    private $confirmation;
    private $dateOfBirth;
    private $defaultBilling;
    private $defaultShipping;
    private $createdIn;
    private $createdAt;
    private $updatedAt;
    private $addresses;

    public static function of(string $email): self
    {
        $productData = new self($email);
        $productData->customAttributes = CustomAttributeSet::create();
        $productData->extensionAttributes = ExtensionAttributeSet::create();
        $productData->addresses = AddressSet::create();

        return $productData;
    }

    public function toJson(): array
    {
        $json = [
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'group_id' => $this->groupId,
            'default_billing' => $this->defaultBilling,
            'default_shipping' => $this->defaultShipping,
            'confirmation' => $this->confirmation,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'created_in' => $this->createdIn,
            'dob' => $this->dateOfBirth,
            'middlename' => $this->middlename,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'gender' => $this->gender,
            'store_id' => $this->storeId,
            'taxvat' => $this->taxVAT,
            'website_id' => $this->websiteId,
            'extension_attributes' => $this->extensionAttributes->toJson(),
            'custom_attributes' => $this->customAttributes->toJson()
        ];

        if ($this->id !== null) {
            $json['id'] = $this->id;
        }

        // optionals
        if ($this->addresses->count()) {
            $json['addresses'] = $this->addresses->toJson();
        }

        return $json;
    }

    public function withId($id)
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function withWebsiteId($websiteId)
    {
        $result = clone $this;
        $result->websiteId = $websiteId;
        return $result;
    }

    public function getWebsiteId()
    {
        return $this->websiteId;
    }

    public function withGroupId($groupId)
    {
        $result = clone $this;
        $result->groupId = $groupId;
        return $result;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function withPrefix($prefix)
    {
        $result = clone $this;
        $result->prefix = $prefix;
        return $result;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function withSuffix($suffix): self
    {
        $result = clone $this;
        $result->suffix = $suffix;
        return $result;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function withGender($gender): self
    {
        $result = clone $this;
        $result->gender = $gender;
        return $result;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function withConfirmation($confirmation): self
    {
        $result = clone $this;
        $result->confirmation = $confirmation;
        return $result;
    }

    public function getConfirmation()
    {
        return $this->confirmation;
    }

    public function withCreatedAt($createdAt): self
    {
        $result = clone $this;
        $result->createdAt = $createdAt;
        return $result;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function withCreatedIn($createdIn): self
    {
        $result = clone $this;
        $result->createdIn = $createdIn;
        return $result;
    }

    public function getCreatedIn()
    {
        return $this->createdIn;
    }

    public function withUpdatedAt($updatedAt): self
    {
        $result = clone $this;
        $result->updatedAt = $updatedAt;
        return $result;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function withTaxVAT($taxVAT): self
    {
        $result = clone $this;
        $result->taxVAT = $taxVAT;
        return $result;
    }

    public function getTaxVAT()
    {
        return $this->taxVAT;
    }

    public function withFirstname($firstname): self
    {
        $result = clone $this;
        $result->firstname = $firstname;
        return $result;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function withLastname($lastname): self
    {
        $result = clone $this;
        $result->lastname = $lastname;
        return $result;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function withMiddlename(string $middlename=null): self
    {
        $result = clone $this;
        $result->middlename = $middlename;
        return $result;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function withDateOfBirth($dateOfBirth): self
    {
        $result = clone $this;
        $result->dateOfBirth = $dateOfBirth;
        return $result;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function withAddresses(AddressSet $addressSet): self
    {
        $result = clone $this;
        $result->addresses = $addressSet;
        return $result;
    }

    public function getAddresses(): AddressSet
    {
        return $this->addresses;
    }

    public function withStoreId(int $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function equals($otherCustomerData): bool
    {
        return $otherCustomerData instanceof CustomerData &&
        ($this->id === $otherCustomerData->id) &&
        ($this->email === $otherCustomerData->email) &&
        ($this->firstname === $otherCustomerData->firstname) &&
        ($this->lastname === $otherCustomerData->lastname) &&
        ($this->groupId === $otherCustomerData->groupId) &&
        ($this->defaultBilling === $otherCustomerData->defaultBilling) &&
        ($this->defaultShipping === $otherCustomerData->defaultShipping) &&
        ($this->confirmation === $otherCustomerData->confirmation) &&
        ($this->createdIn === $otherCustomerData->createdIn) &&
        ($this->createdAt === $otherCustomerData->createdAt) &&
        ($this->updatedAt === $otherCustomerData->updatedAt) &&
        ($this->dateOfBirth === $otherCustomerData->dateOfBirth) &&
        ($this->middlename === $otherCustomerData->middlename) &&
        ($this->prefix === $otherCustomerData->prefix) &&
        ($this->suffix === $otherCustomerData->suffix) &&
        ($this->gender === $otherCustomerData->gender) &&
        ($this->storeId === $otherCustomerData->storeId) &&
        ($this->taxVAT === $otherCustomerData->taxVAT) &&
        ($this->websiteId === $otherCustomerData->websiteId) &&
        ($this->extensionAttributes->equals($otherCustomerData->extensionAttributes) &&
        $this->customAttributes->equals($otherCustomerData->customAttributes));
    }

    private function __construct(string $email)
    {
        $this->email = $email;
    }
}
