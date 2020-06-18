<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeOptionStoreLabel;

class AttributeOptionStoreLabelTest extends TestCase
{
    public function testToJson()
    {
        $attributeOptionStoreLabel = AttributeOptionStoreLabel::of("en_gb", "Test");
        self::assertEquals([
            'store_code' => 'en_gb',
            'label' => 'Test'
        ], $attributeOptionStoreLabel->toJson());
    }

    public function testEquals()
    {
        $storeLabelA =  AttributeOptionStoreLabel::of("en_gb", "Test");
        $sameAsA = $storeLabelA;
        self::assertTrue($storeLabelA->equals($sameAsA));
        self::assertFalse($storeLabelA->equals(AttributeOptionStoreLabel::of("en_gb", "Test2")));
        self::assertFalse($storeLabelA->equals(AttributeOptionStoreLabel::of("eu_eu", "Test")));
    }
}
