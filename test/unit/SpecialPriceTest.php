<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\SpecialPrice;

class SpecialPriceTest extends TestCase
{
    public function testToJson()
    {
        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        );
        self::assertEquals([
            "price" => "7.65",
            "store_id" => "1",
            "sku" => "BMP124",
            "price_from" => '2019-12-04 13:48:05',
            "price_to" => '2019-12-07 00:00:00'
        ], $specialPrice->toJson());
    }

    public function testAccessors()
    {
        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        );
        self::assertEquals('BMP124', $specialPrice->getSku());
        self::assertEquals('7.65', $specialPrice->getPrice());
        self::assertEquals('1', $specialPrice->getStoreId());
        self::assertEquals('2019-12-04 13:48:05', $specialPrice->getPriceFrom());
        self::assertEquals('2019-12-07 00:00:00', $specialPrice->getPriceTo());
    }

    public function testEquals()
    {
        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        );
        $otherSpecialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        );
        self::assertTrue($specialPrice->equals($otherSpecialPrice));
        self::assertFalse((SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        ))->equals(
            SpecialPrice::of(
                '2' ,
                '5.65',
                'BMP124',
                '2020-01-01 00:00:00',
                '2020-01-28 00:00:00'
            )
        ));
    }

    public function testWitherToSet()
    {
        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPrice('5.65');
        self::assertSame('5.65', $specialPrice->getPrice());
        self::assertInstanceOf(SpecialPrice::class, $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPrice('5.65'));

        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withStoreId('2');
        self::assertSame('2', $specialPrice->getStoreId());
        self::assertInstanceOf(SpecialPrice::class, $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withStoreId('2'));

        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withSku('TEST');
        self::assertSame('TEST', $specialPrice->getSku());
        self::assertInstanceOf(SpecialPrice::class, $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withSku('TEST'));

        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPriceFrom('2020-12-04 13:48:05');
        self::assertSame('2020-12-04 13:48:05', $specialPrice->getPriceFrom());
        self::assertInstanceOf(SpecialPrice::class, $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPriceFrom('2020-12-04 13:48:05'));

        $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPriceTo('2021-12-04 13:48:05');
        self::assertSame('2021-12-04 13:48:05', $specialPrice->getPriceTo());
        self::assertInstanceOf(SpecialPrice::class, $specialPrice = SpecialPrice::of(
            '1' ,
            '7.65',
            'BMP124',
            '2019-12-04 13:48:05',
            '2019-12-07 00:00:00'
        )->withPriceTo('2021-12-04 13:48:05'));

    }
}
