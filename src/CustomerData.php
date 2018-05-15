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
    private $address;
    private $defaultBilling;
    private $defaultShipping;
    private $createdIn;
    private $dob;

    public static function of(string $email): self
    {
        $productData = new self($email);
        $productData->customAttributes = CustomAttributeSet::create();
        $productData->extensionAttributes = ExtensionAttributeSet::create();

        return $productData;
    }

    public function toJson(): array
    {
        $json = [
            'id' => $this->id,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'group_id' => $this->groupId,
            'default_billing' => $this->defaultBilling,
            'default_shipping' => $this->defaultShipping,
            'confirmation' => $this->confirmation,
            'created_in' => $this->createdIn,
            'dob' => $this->dob,
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

    public function withSuffix($suffix)
    {
        $result = clone $this;
        $result->suffix = $suffix;
        return $result;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function withGender($gender)
    {
        $result = clone $this;
        $result->gender = $gender;
        return $result;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function withConfirmation($confirmation)
    {
        $result = clone $this;
        $result->confirmation = $confirmation;
        return $result;
    }

    public function getConfirmation()
    {
        return $this->confirmation;
    }

    public function withTaxVAT($taxVAT)
    {
        $result = clone $this;
        $result->taxVAT = $taxVAT;
        return $result;
    }

    public function getTaxVAT()
    {
        return $this->taxVAT;
    }

    public function withFirstname($firstname)
    {
        $result = clone $this;
        $result->firstname = $firstname;
        return $result;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function withLastname($lastname)
    {
        $result = clone $this;
        $result->lastname = $lastname;
        return $result;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function withMiddlename($middlename)
    {
        $result = clone $this;
        $result->middlename = $middlename;
        return $result;
    }

    public function getMiddlename()
    {
        return $this->middlename;
    }

    public function withDateOfBirth($dateOfBirth)
    {
        $result = clone $this;
        $result->dateOfBirth = $dateOfBirth;
        return $result;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function withAddress($address)
    {
        $result = clone $this;
        $result->address = $address;
        return $result;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function withCustomAttributes($customAttributes)
    {
        $result = clone $this;
        $result->customAttributes = $customAttributes;
        return $result;
    }

    public function getCustomAttributes()
    {
        return $this->customAttributes;
    }

    public function withExtensionAttributes($extensionAttributes)
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function getExtensionAttributes()
    {
        return $this->extensionAttributes;
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
        ($this->dob === $otherCustomerData->dob) &&
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
