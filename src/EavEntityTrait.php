<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel;

trait EavEntityTrait
{
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
        $result->customAttributes = $result->customAttributes = $customAttributes;
        return $result;
    }

    /** @var CustomAttributeSet */
    private $customAttributes;
}
