<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\BaseValueObject;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

/**
 * Class Arguments
 * @package SnowIO\Magento2DataModel\Shipment
 * @method ExtensionAttributeSet getExtensionAttributes
 * @method Arguments withExtensionAttributes(ExtensionAttributeSet $extensionAttributeSet)
 */
final class Arguments extends BaseValueObject
{

    public static function create(): self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        $result = $result->withExtensionAttributes(
            ExtensionAttributeSet::fromJson($json['extension_attributes'])
        );
        return $result;
    }

    public function toJson() : array
    {
        return [
            'extension_attributes' => $this->getExtensionAttributes()->toJson()
        ];
    }
}