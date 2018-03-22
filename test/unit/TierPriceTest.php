<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\TierPrice;

class TierPriceTest extends TestCase
{
    public function testToJson()
    {
        $customAttribute = TierPrice::of(99, 1, '100.1999');
        self::assertEquals([
            'customer_group_id' => 99,
            'qty' => 1,
            'value' => '100.1999',
            'extension_attributes' => [],
        ], $customAttribute->toJson());
    }

    public function testExtension()
    {
        $customAttribute = TierPrice::of(99, 1, '100.00')->withWebsiteId(0);
        self::assertEquals([
            'customer_group_id' => 99,
            'qty' => 1,
            'value' => '100.00',
            'extension_attributes' => [
                'website_id' => 0,
            ],
        ], $customAttribute->toJson());
    }

    public function testAccessors()
    {
        $tierPrice = TierPrice::of(99, 1, '100.00');
        self::assertEquals(99, $tierPrice->getCustomerGroupId());
        self::assertEquals(1, $tierPrice->getQty());
        self::assertEquals('100.00', $tierPrice->getValue());
    }

    public function testEquals()
    {
        $tierPrice = TierPrice::of(1, 1, '80.99');
        $otherTierPrice = TierPrice::of(1, 1, '80.99');
        self::assertTrue($tierPrice->equals($otherTierPrice));
        self::assertFalse((TierPrice::of(222, 0, '123.11'))->equals(TierPrice::of(333, 0, '123.11')));
    }

    public function testEqualsWithWebsiteId()
    {
        $tierPrice = TierPrice::of(1, 1, '80.99')->withWebsiteId(1);

        self::assertTrue($tierPrice->equals(
            TierPrice::of(1, 1, '80.99')->withWebsiteId(1)
        ));

        self::assertFalse($tierPrice->equals(
            TierPrice::of(1, 1, '80.99')->withWebsiteId(0)
        ));
    }
}
