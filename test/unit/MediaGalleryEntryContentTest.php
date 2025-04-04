<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\MediaGalleryEntryContent;

class MediaGalleryEntryContentTest extends TestCase
{
    public function testToJson()
    {
        $mediaGallery = MediaGalleryEntryContent::of('type', 'name', 'encoded');

        $this->assertEquals([
                'type' => 'type',
                'name' => 'name',
                'base64_encoded_data' => 'encoded'
        ], $mediaGallery->toJson());
    }

    public function testFromJson()
    {
        $mediaGallery = MediaGalleryEntryContent::fromJson([
            'base64_encoded_data' => 'test',
            'type' => 'image/png',
            'name' => 'test',
        ]);

        $this->assertEquals([
            'base64_encoded_data' => 'test',
            'type' => 'image/png',
            'name' => 'test',
        ], $mediaGallery->toJson());
    }

    public function testAccessors()
    {
        $mediaGallery = MediaGalleryEntryContent::fromJson([
            'base64_encoded_data' => 'test',
            'type' => 'image/png',
            'name' => 'test',
        ]);

        $this->assertEquals('image/png', $mediaGallery->getType());
        $this->assertEquals('test', $mediaGallery->getName());
        $this->assertEquals('test', $mediaGallery->getBase64EncodedData());
    }

    public function testConstructor()
    {
        $mediaGallery = MediaGalleryEntryContent::of('image/png', 'test', 'test');

        $this->assertEquals('image/png', $mediaGallery->getType());
        $this->assertEquals('test', $mediaGallery->getName());
        $this->assertEquals('test', $mediaGallery->getBase64EncodedData());
    }

    public function testWithers()
    {
        $mediaGallery = MediaGalleryEntryContent::create()
            ->withName('test')
            ->withType('image/png')
            ->withBase64EncodedData('test');

        $this->assertEquals('image/png', $mediaGallery->getType());
        $this->assertEquals('test', $mediaGallery->getName());
        $this->assertEquals('test', $mediaGallery->getBase64EncodedData());
    }

    public function testEquals()
    {
        $mediaGallery = MediaGalleryEntryContent::fromJson([
            'type' => 'type',
            'name' => 'name',
            'base64_encoded_data' => 'encoded',
        ]);

        $mediaGallery2 = MediaGalleryEntryContent::of('type', 'name', 'encoded');

        $this->assertTrue($mediaGallery->equals($mediaGallery2));
    }
}
