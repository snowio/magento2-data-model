<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\ProductData;

class CustomAttributeTest extends TestCase
{

    public function testInitialisation()
    {
        $customAttribute = CustomAttribute::of('product_weight', '80');
        self::assertEquals([
            'attribute_code' => 'product_weight',
            'value' => '80',
        ],$customAttribute->toJson());
    }

    public function testAccessors()
    {
        $customAttribute = CustomAttribute::of('product_weight', '80');
        self::assertEquals('product_weight', $customAttribute->getCode());
        self::assertEquals('80', $customAttribute->getValue());
        self::assertFalse((CustomAttribute::of('status', 'data'))->equals(ProductData::of('foo-bar', 'test')));
    }

    public function testEquals()
    {
        $customAttribute = CustomAttribute::of('product_weight', '80');
        $otherAttribute = CustomAttribute::of('product_weight', '80');
        self::assertTrue($customAttribute->equals($otherAttribute));
    }

}