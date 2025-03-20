<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\MediaGalleryEntry;

class MediaGalleryEntryTest extends TestCase
{
    public function testToJson()
    {
        $mediaGallery = MediaGalleryEntry::of('image', 'Label')
            ->withFile('path/image.jpg')
            ->withTypes(['image', 'small_image', 'thumbnail']);

        $this->assertEquals([
                'media_type' => 'image',
                'label' => 'Label',
                'position' => 0,
                'disabled' => false,
                'file' => 'path/image.jpg',
                'types' => ['image', 'small_image', 'thumbnail']
        ], $mediaGallery->toJson());
    }

    public function testFromJson()
    {
        $mediaGallery = MediaGalleryEntry::fromJson([
            'media_type' => 'image',
            'label' => 'Label',
            'position' => 0,
            'disabled' => false,
            'file' => 'path/image.jpg',
            'types' => ['image', 'small_image', 'thumbnail']
        ]);

        $this->assertEquals([
            'media_type' => 'image',
            'label' => 'Label',
            'position' => 0,
            'disabled' => false,
            'file' => 'path/image.jpg',
            'types' => ['image', 'small_image', 'thumbnail']
        ], $mediaGallery->toJson());
    }

    public function testAccessors()
    {
        $mediaGallery = MediaGalleryEntry::of('image', 'Label');

        $this->assertEquals('image', $mediaGallery->getMediaType());
        $this->assertEquals('Label', $mediaGallery->getLabel());
        $this->assertEquals(0, $mediaGallery->getDisabled());
        $this->assertEquals(0, $mediaGallery->getPosition());
        $this->assertEquals(null, $mediaGallery->getFile());
        $this->assertEquals([], $mediaGallery->getTypes());

        $mediaGallery = MediaGalleryEntry::of('image', 'Label')
            ->withFile('path/image.jpg')
            ->withTypes(['image', 'small_image', 'thumbnail'])
            ->withDisabled(true)
            ->withPosition(1)
            ->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of('video_content', [
                        "media_type" => 'external-video',
                        "video_provider" => 'youtube',
                        "video_url" => 'https://www.youtube.com/watch?v=fake',
                        "video_title" => 'Video title',
                        "video_description" => 'Video description',
                        "video_metadata" => '',
                    ])
                ])
            );

        $this->assertEquals(1, $mediaGallery->getDisabled());
        $this->assertEquals(1, $mediaGallery->getPosition());
        $this->assertEquals(['video_content'=> [
            'media_type' => 'external-video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=fake',
            'video_title' => 'Video title',
            'video_description' => 'Video description',
            'video_metadata' => '',
        ]], $mediaGallery->getExtensionAttributes()->toJson());
        $this->assertEquals('path/image.jpg', $mediaGallery->getFile());
        $this->assertEquals(['image', 'small_image', 'thumbnail'], $mediaGallery->getTypes());
    }

    public function testEquals()
    {
        $mediaGallery = MediaGalleryEntry::fromJson([
            'media_type' => 'image',
            'label' => 'Label',
            'position' => 0,
            'disabled' => false,
            'file' => 'path/image.jpg',
            'types' => ['image', 'small_image', 'thumbnail']
        ]);

        $mediaGallery2 = MediaGalleryEntry::of('image', 'Label')
            ->withFile('path/image.jpg')
            ->withTypes(['image', 'small_image', 'thumbnail'])
            ->withDisabled(false)
            ->withPosition(0);

        $this->assertTrue($mediaGallery->equals($mediaGallery2));
    }
}
