<?php
namespace SnowIO\Magento2DataModel;

final class MediaGalleryEntry implements ValueObject
{

    private $mediaType;
    private $label;
    private $position;
    private $disabled;
    private $types;
    private $file;
    /**
     * TODO add content and extention_attributes
     */

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function withFile($file): self
    {
        $result = clone $this;
        $result->file = $file;
        return $result;
    }

    public function withTypes($types): self
    {
        $result = clone $this;
        $result->$types = $types;
        return $result;
    }

    public function withDisabled($disabled): self
    {
        $result = clone $this;
        $result->disabled = $disabled;
        return $result;
    }

    public function withPosition($position): self
    {
        $result = clone $this;
        $result->position= $position;
        return $result;
    }

    public function withLabel($label): self
    {
        $result = clone $this;
        $result->label = $label;
        return $result;
    }

    public function withMediaType($mediaType): self
    {
        $result = clone $this;
        $result->mediaType = $mediaType;
        return $result;
    }

    public static function create()
    {
        return new self;
    }

    public function equals($object): bool
    {
        return ($object instanceof MediaGalleryEntry) &&
            ($this->getDisabled() === $object->getDisabled()) &&
            ($this->getFile() === $object->getFile()) &&
            ($this->getLabel() === $object->getLabel()) &&
            ($this->getPosition() === $object->getPosition()) &&
            ($this->getMediaType() === $object->getMediaType()) &&
            ($this->getTypes() === $object->getTypes());
    }

    public function fromJson($json): MediaGalleryEntry
    {
        return self::create()
            ->withMediaType($json['media_type'])
            ->withFile($json['file'])
            ->withLabel($json['label'])
            ->withDisabled($json['disabled'])
            ->withTypes($json['types'])
            ->withPosition($json['position']);
    }

    public function toJson(): array
    {
        $json = [
            'media_type' => $this->mediaType,
            'label' => $this->label,
            'position' => $this->position,
            'disabled' => $this->disabled,
            'types' => $this->types,
            'file' => $this->file,

        ];

        return $json;
    }

}

/**
 *
"media_gallery_entries": [
{
    "id": 0,
    "media_type": "string",
    "label": "string",
    "position": 0,
    "disabled": true,
    "types": [
        "string"
    ],
    "file": "string",
    "content": {
        "base64_encoded_data": "string",
        "type": "string",
        "name": "string"
    },
    "extension_attributes": {
        "video_content": {
        "media_type": "string",
        "video_provider": "string",
        "video_url": "string",
        "video_title": "string",
        "video_description": "string",
        "video_metadata": "string"
    }
}

 */