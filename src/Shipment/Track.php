<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class Track implements ValueObject
{
    /** @var string $carrierCode */
    private $carrierCode;
    /** @var string $title */
    private $title;
    /** @var ExtensionAttributeSet */
    private $extensionAttributes;
    /** @var string $trackNumber */
    private $trackNumber;

    public static function create() : self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json) : self
    {
        $result = new self();
        $result->carrierCode = $json['carrier_code'];
        $result->title = $json['title'];
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        $result->trackNumber = $json['track_number'];
        return $result;
    }

    /**
     * @return string
     */
    public function getCarrierCode(): string
    {
        return $this->carrierCode;
    }

    /**
     * @param string $carrierCode
     * @return Track
     */
    public function withCarrierCode(string $carrierCode): Track
    {
        $clone = clone $this;
        $clone->carrierCode = $carrierCode;
        return $clone;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Track
     */
    public function withTitle(string $title): Track
    {
        $clone = clone $this;
        $clone->title = $title;
        return $clone;
    }

    /**
     * @return ExtensionAttributeSet
     */
    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    /**
     * @param ExtensionAttributeSet $extensionAttributes
     * @return Track
     */
    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes): Track
    {
        $clone = clone $this;
        $clone->extensionAttributes = $extensionAttributes;
        return $clone;
    }

    /**
     * @return string
     */
    public function getTrackNumber(): string
    {
        return $this->trackNumber;
    }

    /**
     * @param string $trackNumber
     * @return Track
     */
    public function withTrackNumber(string $trackNumber): Track
    {
        $clone = clone $this;
        $clone->trackNumber = $trackNumber;
        return $clone;
    }
    
    public function toJson() : array
    {
        return [
            'carrier_code' => $this->carrierCode,
            'title' => $this->title,
            'extension_attributes' => $this->extensionAttributes->toJson(),
            'track_number' => $this->trackNumber
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
            $this->carrierCode === $other->carrierCode &&
            $this->title === $other->title &&
            $this->extensionAttributes->equals($other->extensionAttributes) &&
            $this->trackNumber === $other->trackNumber;
    }

    protected function __construct()
    {
    }
}
