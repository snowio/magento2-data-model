<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\SpecialPriceSet;
use SnowIO\Magento2DataModel\SpecialPrice;

class SpecialPriceSetTest extends TestCase
{
    public function testDefaultValues()
    {
        $specialPriceSet = SpecialPriceSet::of([
            $specialPrice = SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
        ]);

        self::assertEquals([[
            "price" => "7.65",
            "store_id" => "1",
            "sku" => "BMP124",
            "price_from" => '2019-12-04 13:48:05',
            "price_to" => '2019-12-07 00:00:00'
        ]], $specialPriceSet->toJson());
    }

    public function testGetShouldUseCompoundKey()
    {
        $specialPriceSet = SpecialPriceSet::create()->withSpecialPrice(
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            )
        );

        self::assertInstanceOf(SpecialPrice::class, $specialPriceSet->get(
            '1-7.65-BMP124-2019-12-04_13:48:05-2019-12-07_00:00:00'
        ));
        self::assertNull($specialPriceSet->get('any-invalid-key'));
    }

    public function testToJson()
    {
        $specialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '5.65',
                'MPB124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            )
        ]);

        self::assertEquals([
            [
                'store_id' => '1',
                'price' => '7.65',
                'sku' => 'BMP124',
                'price_from' => '2019-12-04 13:48:05',
                'price_to' => '2019-12-07 00:00:00'
            ],
            [
                'store_id' => '2',
                'price' => '5.65',
                'sku' => 'MPB124',
                'price_from' => '2020-12-04 13:48:05',
                'price_to' => '2020-12-07 00:00:00'
            ]
        ], $specialPriceSet->toJson());
    }

    /**
     * @expectedException \SnowIO\Magento2DataModel\MagentoDataException
     * @expectedMessage Cannot set SpecialPrice with same to_date and from_date
     */
    public function aatestInvalidSetProductLinkTwice()
    {
        SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '5.65',
                'MPB124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            )
        ]);
    }

    public function testWitherToSet()
    {
        /** @var $specialPriceSet SpecialPriceSet */
        $specialPriceSet = SpecialPriceSet::create();

        self::assertTrue($specialPriceSet->isEmpty());

        $specialPriceSet = $specialPriceSet
            ->withSpecialPrice(SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ));

        self::assertEquals(1, $specialPriceSet->count());

        $specialPriceSet = $specialPriceSet
            ->withSpecialPrice(SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ))
            ->withSpecialPrice(SpecialPrice::of(
            '3' ,
            '7.65',
            'BMP124',
            '2021-12-04 13:48:05',
            '2021-12-07 00:00:00'
            ));

        $expectedSpecialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '3' ,
                '7.65',
                'BMP124',
                '2021-12-04 13:48:05',
                '2021-12-07 00:00:00'
            )
        ]);

        self::assertTrue($expectedSpecialPriceSet->equals($specialPriceSet));
    }

    public function testAddToSet()
    {
        $specialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            )
        ]);

        $anotherSpecialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '3' ,
                '7.65',
                'BMP124',
                '2021-12-04 13:48:05',
                '2021-12-07 00:00:00'
            )
        ]);

        $specialPriceSet = $specialPriceSet->add($anotherSpecialPriceSet);
        $expectedSpecialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '3' ,
                '7.65',
                'BMP124',
                '2021-12-04 13:48:05',
                '2021-12-07 00:00:00'
            )
        ]);

        self::assertTrue($expectedSpecialPriceSet->equals($specialPriceSet));
    }

    public function testEquality()
    {
        $specialPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '3' ,
                '7.65',
                'BMP124',
                '2021-12-04 13:48:05',
                '2021-12-07 00:00:00'
            )
        ]);

        $otherPriceSet = SpecialPriceSet::of([
            SpecialPrice::of(
                '1' ,
                '7.65',
                'BMP124',
                '2019-12-04 13:48:05',
                '2019-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '2' ,
                '7.65',
                'BMP124',
                '2020-12-04 13:48:05',
                '2020-12-07 00:00:00'
            ),
            SpecialPrice::of(
                '3' ,
                '7.65',
                'BMP124',
                '2021-12-04 13:48:05',
                '2021-12-07 00:00:00'
            )
        ]);

        self::assertTrue($specialPriceSet->equals($otherPriceSet));
    }
}
