<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;


use SnowIO\Magento2DataModel\BaseValueObject;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

/**
 * Class Track
 * @package SnowIO\Magento2DataModel\Shipment
 * @method string getTrackNumber()
 * @method string getCarrierCode()
 * @method string getTitle()
 * @method ExtensionAttributeSet getExtensionAttributes()
 * @method Track withTrackNumber(?string $trackNumber)
 * @method Track withCarrierCode(?string $carrierCode)
 * @method Track withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
 * @method Track withTitle(string $title)
 */
final class Track extends BaseValueObject
{

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }


    public static function fromJson(array $json) : self
    {
        return self::create()
            ->withExtensionAttributes(
                ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? [])
            )
            ->withTrackNumber($json['track_number'])
            ->withTitle($json['title'])
            ->withCarrierCode($json['carrier_code']);
    }

    public function toJson() : array
    {
        return [
            'title' => $this->getTitle(),
            'track_number' => $this->getTrackNumber(),
            'carrier_code' => $this->getCarrierCode(),
            'extension_attributes' => $this->getExtensionAttributes()->toJson()
        ];
    }
}