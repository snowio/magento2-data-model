<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

interface ExtensionAttributeValue
{
    public function toJson(): array;

    public function equals($value): bool;
}
