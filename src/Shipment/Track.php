<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Track implements ValueObject
{
    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->trackNumber = $json['track_number'];
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes']);
        $result->title = $json['title'];
        $result->carrierCode = $json['carrier_code'];
        return $result;
    }

    public function getTrackNumber()
    {
        return $this->trackNumber;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCarrierCode()
    {
        return $this->carrierCode;
    }

    public function getExtensionAttributes()
    {
        return $this->extensionAttributes;
    }

    public function withTrackNumber(string $trackNumber): self
    {
        $result = clone $this;
        $result->trackNumber = $trackNumber;
        return $result;
    }

    public function withTitle(string $title): self
    {
        $result = clone $this;
        $result->title = $title;
        return $result;
    }

    public function withCarrierCode(string $carrierCode): self
    {
        $result = clone $this;
        $result->carrierCode = $carrierCode;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }
    
    public function toJson() : array
    {
        return [
            'title' => $this->title,
            'track_number' => $this->trackNumber,
            'carrier_code' => $this->carrierCode,
            'extension_attributes' => $this->extensionAttributes->toJson()
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
        $this->title === $other->title &&
        $this->trackNumber === $other->trackNumber &&
        $this->carrierCode === $other->carrierCode &&
        $this->extensionAttributes->equals($other->extensionAttributes);
    }

    private $title;
    private $trackNumber;
    private $carrierCode;
    /** @var  ExtensionAttributeSet */
    private $extensionAttributes;

    protected function __construct()
    {
    }
}
