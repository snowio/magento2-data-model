<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

class ExtensionAttribute implements ValueObject
{
    public static function of(string $code, $value)
    {
        return new self($code, $value);
    }

    public static function fromJson(array $json): self
    {
        $value = reset($json);
        return self::of(key($json), $value);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function toJson(): array
    {
        return [
            $this->code => $this->value,
        ];
    }

    public function getValue()
    {
        return $this->value;
    }

    public function equals($extensionAttribute): bool
    {
        return $extensionAttribute instanceof ExtensionAttribute
            && $extensionAttribute->code === $this->code
            && $extensionAttribute->value === $this->value;
    }

    private $code;
    private $value;

    protected function __construct(string $code, $value)
    {
        $this->code = $code;
        $this->value = $value;
    }
}
