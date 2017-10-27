<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class Attribute
{
    public static function of(string $attributeCode, string $frontendInput, string $adminLabel): self
    {

    }

    public function getCode(): string
    {

    }

    public function isRequired(): bool
    {

    }

    public function withIsRequired(bool $isRequired): self
    {

    }

    public function getFrontendInput(): string
    {

    }

    public function withFrontendInput(string $frontendInput): self
    {

    }

    public function getFrontendLabels(): array
    {

    }

    public function getDefaultFrontendLabel()
    {

    }

    public function toJson(): array
    {

    }

    public function equals($attribute): bool
    {

    }

    private function __construct()
    {

    }
}
