<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

final class SwatchInputType
{
    const VISUAL = 'visual';
    const TEXT = 'text';
    const DROPDOWN = 'dropdown';

    const ALL = [
        self::VISUAL,
        self::TEXT,
        self::DROPDOWN,
    ];
}
