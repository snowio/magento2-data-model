<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel;

trait EavEntityTrait
{
    use ExtensionAttributeTrait;
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

    public function getStoreCode(): string
    {
        return $this->storeCode;
    }

    public function withStoreCode(string $storeCode): self
    {
        $result = clone $this;
        $result->storeCode = $storeCode;
        return $result;
    }

    private $storeCode = 'admin';

    /** @var CustomAttributeSet */
    private $customAttributes;
}
