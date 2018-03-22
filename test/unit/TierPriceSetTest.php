<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\TierPrice;
use SnowIO\Magento2DataModel\TierPriceSet;

class TierPriceSetTest extends TestCase
{
    public function testToJson()
    {
        $tierPriceSet = TierPriceSet::of([
            TierPrice::of(1, 1, '900.19999999')->withWebsiteId(1),
            TierPrice::of(2, 1, '90.00'),
            TierPrice::of(3, 1, '40.00'),
        ]);

        self::assertEquals([
            [
                'customer_group_id' => 1,
                'qty' => 1,
                'value' => '900.19999999',
                'extension_attributes' => [
                    'website_id' => 1
                ]
            ],
            [
                'customer_group_id' => 2,
                'qty' => 1,
                'value' => '90.00',
                'extension_attributes' => []
            ],
            [
                'customer_group_id' => 3,
                'qty' => 1,
                'value' => '40.00',
                'extension_attributes' => []
            ],
        ], $tierPriceSet->toJson());
    }

    /**
     * @expectedException SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Cannot set TierPrice with same qty to the same group
     */
    public function testInvalidSetTierPriceTwice()
    {
        TierPriceSet::of([
            TierPrice::of(1, 1, '900'),
            TierPrice::of(1, 1, '90'),
            TierPrice::of(2, 1, '1'),
        ]);
    }

    public function testWitherToSet()
    {
        $priceTierSet = TierPriceSet::create();

        self::assertTrue($priceTierSet->isEmpty());

        $priceTierSet = $priceTierSet
            ->withTierPrice(TierPrice::of(99, 1, '99.99'));

        self::assertEquals(1, $priceTierSet->count());

        $priceTierSet = $priceTierSet
            ->withTierPrice(TierPrice::of(1, 1, '800.00'))
            ->withTierPrice(TierPrice::of(2, 3, '30.00'))
            ->withTierPrice(TierPrice::of(3, 10, '90.00'));

        $expectedPriceTierSet = TierPriceSet::of([
            TierPrice::of(99, 1, '99.99'),
            TierPrice::of(1, 1, '800.00'),
            TierPrice::of(2, 3, '30.00'),
            TierPrice::of(3, 10, '90.00'),
        ]);

        self::assertTrue($expectedPriceTierSet->equals($priceTierSet));
    }

    public function testAddToSet()
    {
        $priceTierSet = TierPriceSet::of([
            TierPrice::of(1, 90, '10.00'),
        ]);

        $anotherPriceTier = TierPriceSet::of([
            TierPrice::of(1, 2, '90'),
            TierPrice::of(1, 5, '40'),
        ]);

        $priceTierSet = $priceTierSet->add($anotherPriceTier);
        $expectedAttributeSet = TierPriceSet::of([
            TierPrice::of(1, 90, '10.00'),
            TierPrice::of(1, 2, '90'),
            TierPrice::of(1, 5, '40'),
        ]);

        self::assertTrue($expectedAttributeSet->equals($priceTierSet));
    }

    public function testEquality()
    {
        $priceList = TierPriceSet::of([
            TierPrice::of(1, 1, '99.00'),
            TierPrice::of(2, 1, '99.00'),
            TierPrice::of(3, 1, '99.00'),
        ]);

        $otherPriceList = TierPriceSet::of([
            TierPrice::of(1, 1, '99.00'),
            TierPrice::of(2, 1, '99.00'),
            TierPrice::of(3, 1, '99.00'),
        ]);

        self::assertTrue($priceList->equals($otherPriceList));
    }
}
