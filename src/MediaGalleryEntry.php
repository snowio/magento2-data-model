<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class MediaGalleryEntry implements ValueObject
{

    private $mediaType;
    private $label;
    private $types = [];
    private $file = null;
    private $disabled = false;
    private $position = 0;
    private $extensionAttributes;

    public static function of(string $mediaType, string $label)
    {
        $mediaGalleryEntry = new self($mediaType, $label);
        return $mediaGalleryEntry;
    }

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

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function withFile(string $file): self
    {
        $result = clone $this;
        $result->file = $file;
        return $result;
    }

    public function withTypes(array $types): self
    {
        $result = clone $this;
        $result->types = $types;
        return $result;
    }

    public function withDisabled(bool $disabled): self
    {
        $result = clone $this;
        $result->disabled = $disabled;
        return $result;
    }

    public function withPosition(int $position): self
    {
        $result = clone $this;
        $result->position = $position;
        return $result;
    }

    public function withLabel(string $label): self
    {
        $result = clone $this;
        $result->label = $label;
        return $result;
    }

    public function withMediaType(string $mediaType): self
    {
        $result = clone $this;
        $result->mediaType = $mediaType;
        return $result;
    }

    public function equals($object): bool
    {
        return ($object instanceof MediaGalleryEntry) &&
            ($this->disabled === $object->disabled) &&
            ($this->file === $object->file) &&
            ($this->label === $object->label) &&
            ($this->extensionAttributes->equals($object->getExtensionAttributes())) &&
            ($this->position === $object->position) &&
            (empty(array_diff($this->types, $object->types)) && empty(array_diff($object->types, $this->types)));
    }

    public static function fromJson($json): MediaGalleryEntry
    {
        $result = self::of($json['media_type'], $json['label'])
            ->withFile($json['file'])
            ->withDisabled($json['disabled'])
            ->withTypes($json['types'])
            ->withPosition($json['position']);

        if (isset($json['extension_attributes'])) {
            $result = $result->withExtensionAttributes(ExtensionAttributeSet::fromJson($json['extension_attributes']));
        }

        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function getExtensionAttributes(): ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function toJson(): array
    {
        $json = [
            'media_type' => $this->mediaType,
            'label' => $this->label,
            'position' => $this->position,
            'disabled' => $this->disabled,
            'types' => $this->types,
        ];

        if ($this->extensionAttributes->count()) {
            $json['extension_attributes'] = $this->extensionAttributes->toJson();
        }

        if ($this->file !== null) {
            $json['file'] = $this->file;
        }

        return $json;
    }

    private function __construct(string $mediaType, string $label)
    {
        $this->mediaType = $mediaType;
        $this->label = $label;
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }
}
