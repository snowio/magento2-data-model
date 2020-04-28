<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class FrontendInput
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
    const SWATCH_VISUAL = 'swatch_visual';
    const SWATCH_TEXT = 'swatch_text';

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
        self::SWATCH_VISUAL,
        self::SWATCH_TEXT,
    ];
}
