<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class MediaGalleryEntrySet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function withMediaGalleryEntry(MediaGalleryEntry $mediaGalleryEntry): self
    {
        $result = clone $this;
        $result->items[] = $mediaGalleryEntry;
        return $result;
    }

    public function toJson(): array
    {
        $mediaGalleryEntries = [];

        foreach ($this->items as $item) {
            /** @var MediaGalleryEntry $item */
            $mediaGalleryEntries[] = $item->toJson();
        }

        return $mediaGalleryEntries;
    }

    private static function itemsAreEqual(
        MediaGalleryEntry $extensionAttribute,
        MediaGalleryEntry $otherExtensionAttribute
    ) : bool {
        return $extensionAttribute->equals($otherExtensionAttribute);
    }
}
