<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\MediaGalleryEntry;
use SnowIO\Magento2DataModel\MediaGalleryEntrySet;

class MediaGalleryEntrySetTest extends TestCase
{
    public function testToJson()
    {
        $mediaGallerySet = MediaGalleryEntrySet::create()
            ->withMediaGalleryEntry(MediaGalleryEntry::of('image', 'Label')
                ->withTypes(['image', 'small_image', 'thumbnail'])
                ->withFile('path/image.jpg'));

        self::assertSame(1, $mediaGallerySet->count());
        self::assertEquals([
            [
                'media_type' => 'image',
                'label' => 'Label',
                'position' => 0,
                'disabled' => false,
                'types' => [
                    'image', 'small_image', 'thumbnail'
                ],
                'file' => 'path/image.jpg',
            ]
        ], $mediaGallerySet->toJson());
    }

    public function testWitherToSet()
    {
        $mediaGallerySet = MediaGalleryEntrySet::create();
        self::assertTrue($mediaGallerySet->isEmpty());

        $mediaGallerySet = $mediaGallerySet
            ->withMediaGalleryEntry(MediaGalleryEntry::of('mediatype1', 'label1'))
            ->withMediaGalleryEntry(MediaGalleryEntry::of('mediatype1', 'label2'));

        self::assertEquals(2, $mediaGallerySet->count());
    }

    public function testEquality()
    {
        $expectedMediaGalleryEntrySet = MediaGalleryEntrySet::create()
            ->withMediaGalleryEntry(
                MediaGalleryEntry::of('test1', 'a')
                    ->withTypes(['image', 'small_image', 'thumbnail'])
                    ->withFile('path/image.jpg')
                    ->withDisabled(false)
                    ->withPosition(1)
            );

        $differentMediaGalleryEntrySet = MediaGalleryEntrySet::create()
            ->withMediaGalleryEntry(
                MediaGalleryEntry::of('test1', 'a')
                ->withTypes(['image', 'small_image', 'thumbnail'])
                ->withFile('path/image2.jpg')
                ->withDisabled(false)
                ->withPosition(1)
            );

        self::assertTrue($expectedMediaGalleryEntrySet->equals(clone $expectedMediaGalleryEntrySet));
        self::assertFalse($expectedMediaGalleryEntrySet->equals($differentMediaGalleryEntrySet));
    }
}
