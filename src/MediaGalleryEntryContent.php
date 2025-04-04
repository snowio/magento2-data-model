<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class MediaGalleryEntryContent implements ValueObject
{
    private $base64EncodedData = null;
    private $type = null;
    private $name = null;

    public static function create()
    {
        return new self(null, null, null);
    }

    public static function of(string $type, string $name, string $base64EncodedData)
    {
        return new self($type, $name, $base64EncodedData);
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getBase64EncodedData(): ?string
    {
        return $this->base64EncodedData;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function withType(string $type): self
    {
        $result = clone $this;
        $result->type = $type;
        return $result;
    }

    public function withBase64EncodedData(string $base64EncodedData): self
    {
        $result = clone $this;
        $result->base64EncodedData = $base64EncodedData;
        return $result;
    }

    public function equals($object): bool
    {
        return ($object instanceof MediaGalleryEntryContent) &&
            ($this->name === $object->name) &&
            ($this->type === $object->type) &&
            ($this->base64EncodedData === $object->base64EncodedData);
    }

    public static function fromJson($json): MediaGalleryEntryContent
    {
        return self::of($json['type'], $json['name'], $json['base64_encoded_data']);
    }

    public function toJson(): array
    {
        return [
            'base64_encoded_data' => $this->base64EncodedData,
            'type' => $this->type,
            'name' => $this->name,
        ];
    }

    private function __construct(?string $type, ?string $name, ?string $base64EncodedData)
    {
        $this->type = $type;
        $this->name = $name;
        $this->base64EncodedData = $base64EncodedData;
    }
}
