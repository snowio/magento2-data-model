<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CategoryData
{
    private const CODE = 'code';
    private const PARENT_CODE = 'parent_code';

    public static function of(string $code, string $name): self
    {
        $category = new self($code, $name);
        return $category;
    }

    public function getCode(): string
    {
        return $this->extensionAttributes[self::CODE];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function withActive(bool $isActive): self
    {
        $result = clone $this;
        $result->isActive = $isActive;
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
        $result->customAttributes = $result->customAttributes
            ->add($customAttributes);
        return $result;
    }

    public function getParentCode(): ?string
    {
        return $this->extensionAttributes[self::PARENT_CODE] ?? null;
    }

    public function withParent(string $parentCode): self
    {
        $result = clone $this;
        $result->extensionAttributes[self::PARENT_CODE] = $parentCode;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
//            'parent_id' => 1, todo is discuss this
            'is_active' => $this->isActive,
            'custom_attributes' => $this->customAttributes->toJson(),
            'extension_attributes' => $this->extensionAttributes,
        ];
    }

    public function equals($category): bool
    {
        return $category instanceof CategoryData &&
            ($this->name === $category->name) &&
            ($this->isActive === $category->isActive) &&
            ($this->customAttributes->equals($category->customAttributes)) &&
            ($this->extensionAttributes == $category->extensionAttributes);
    }

    private $name;
    private $isActive = false;
    private $customAttributes;
    private $extensionAttributes = [];

    private function __construct(string $code, string $name)
    {
        $this->name = $name;
        $this->customAttributes = CustomAttributeSet::create();
        $this->isActive = true;
        $this->extensionAttributes = [
            self::CODE => $code,
        ];
    }
}
