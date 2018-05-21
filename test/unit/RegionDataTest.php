<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\RegionData;

class RegionDataTest extends TestCase
{
    public function testToJson()
    {
        self::assertSame([
            'region_id' => 0,
            'region_code' => 'code',
            'region' => null
        ], RegionData::of('code')->toJson());
    }

    public function testFromJson()
    {
        $json = [
            'region_id' => 0,
            'region_code' => 'code',
            'region' => 'region'
        ];
        self::assertSame($json, RegionData::fromJson($json)->toJson());
    }

    public function testWithers()
    {
        $region = RegionData::of('code')
            ->withRegionId(1)
            ->withRegion('region');

        self::assertSame($region->toJson(), [
            'region_id' => 1,
            'region_code' => 'code',
            'region' => 'region'
        ]);
    }

    public function testEqualsSimple()
    {
        $region = RegionData::of('aaa');
        self::assertTrue($region->equals(RegionData::of('aaa')));
        self::assertFalse($region->equals(RegionData::of('bbb')));
    }

    public function testGetters()
    {
        $region = RegionData::of('br')
            ->withRegionId(1)
            ->withRegion('Brazil');

        self::assertSame([
            'region_id' => $region->getRegionId(),
            'region_code' => $region->getRegionCode(),
            'region' => $region->getRegion()
        ], $region->toJson());
    }

    public function testEqualsComplete()
    {
        $region = RegionData::of('001')
            ->withRegionId(1)
            ->withRegion('Somewhere');

        // lets change just 1 value
        $region2 = clone $region;
        self::assertTrue($region->equals($region2));
        self::assertFalse($region->equals($region2->withRegion('Other place')));
    }
}

