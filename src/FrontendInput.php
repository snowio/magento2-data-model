<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

class FrontendInput
{
    const TEXT = 'text';
    const SELECT = 'select';
    const MULTISELECT = 'multiselect';
    const BOOLEAN = 'boolean';
    const DATE = 'date';
    const TEXTAREA =  'textarea';
    const GALLERY = 'gallery';
    const PRICE = 'price';
    const IMAGE = 'image';
    const HIDDEN = 'hidden';
    const MULTILINE = 'multiline';
    const MEDIA_IMAGE = 'media_image';

    const ALL = [
        self::TEXT,
        self::SELECT,
        self::MULTISELECT,
        self::BOOLEAN,
        self::DATE,
        self::TEXTAREA,
        self::GALLERY,
        self::PRICE,
        self::IMAGE,
        self::HIDDEN,
        self::MULTILINE,
        self::MEDIA_IMAGE,
    ];

    public static function validateFrontendInput(string $frontendInput)
    {
        if (!in_array($frontendInput, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Frontend Input');
        }
    }
}