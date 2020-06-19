<?php
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeOptionStoreLabel;
use SnowIO\Magento2DataModel\AttributeOptionStoreLabelSet;

class AttributeOptionStoreLabelSetTest extends TestCase
{
    public function testWither()
    {
        $attributeOptionStoreLabelSet = AttributeOptionStoreLabelSet::of([
            AttributeOptionStoreLabel::of('en_gb', "Large"),
            AttributeOptionStoreLabel::of('de_de', "Gross")
        ]);

        $attributeOptionStoreLabelSet = $attributeOptionStoreLabelSet->with(
            AttributeOptionStoreLabel::of("fr_fr", "Grand")
        );

        self::assertTrue($attributeOptionStoreLabelSet->equals(AttributeOptionStoreLabelSet::of([
            AttributeOptionStoreLabel::of('en_gb', "Large"),
            AttributeOptionStoreLabel::of('de_de', "Gross"),
            AttributeOptionStoreLabel::of("fr_fr", "Grand"),
        ])));
    }
}
