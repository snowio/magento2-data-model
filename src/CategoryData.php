<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class CategoryData implements ValueObject
{
    use EavEntityTrait;

    private const CODE = 'code';
    private const PARENT_CODE = 'parent_code';

    public static function of(string $code, string $name): self
    {
        $category = new self($code, $name);
        return $category;
    }

    public function getCode(): string
    {
        $extensionAttribute = $this->extensionAttributes->get(self::CODE);

        if (null === $extensionAttribute) {
            throw new \Exception('Category must have a code');
        }

        return $extensionAttribute->getValue();
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

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function withActive(bool $isActive): self
    {
        $result = clone $this;
        $result->isActive = $isActive;
        return $result;
    }

    public function getParentCode(): ?string
    {
        $extensionAttribute = $this->extensionAttributes->get(self::PARENT_CODE);

        if ($extensionAttribute !== null) {
            return $extensionAttribute->getValue();
        }

        return null;
    }

    public function withParentCode(string $parentCode): self
    {
        $result = clone $this;
        $result->extensionAttributes = $result->extensionAttributes
            ->withExtensionAttribute(ExtensionAttribute::of(self::PARENT_CODE, $parentCode));
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        if (!$extensionAttributes->has(self::CODE)) {
            $code = $result->extensionAttributes->get(self::CODE);
            $extensionAttributes = $extensionAttributes->withExtensionAttribute($code);
        }

        if ($result->extensionAttributes->has(self::PARENT_CODE) && !$extensionAttributes->has(self::PARENT_CODE)) {
            $parentCode = $result->extensionAttributes->get(self::PARENT_CODE);
            $extensionAttributes = $extensionAttributes->withExtensionAttribute($parentCode);
        }

        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function toJson(): array
    {
        $json = [
            'name' => $this->name,
            'is_active' => $this->isActive,
            'custom_attributes' => $this->customAttributes->toJson(),
            'extension_attributes' => $this->extensionAttributes->toJson(),
        ];

        if ($this->getParentCode() === null) {
            $json['parent_id'] = 1;
        }

        return $json;
    }

    public function equals($category): bool
    {
        return $category instanceof CategoryData &&
            ($this->name === $category->name) &&
            ($this->isActive === $category->isActive) &&
            ($this->customAttributes->equals($category->customAttributes)) &&
            ($this->extensionAttributes->equals($category->extensionAttributes)) &&
            ($this->storeCode === $category->storeCode);

    }

    private $name;
    private $isActive = true;

    private function __construct(string $code, string $name)
    {
        $this->name = $name;
        $this->customAttributes = CustomAttributeSet::create();
        $this->extensionAttributes = ExtensionAttributeSet::create()
            ->withExtensionAttribute(ExtensionAttribute::of(self::CODE, $code));
    }
}
