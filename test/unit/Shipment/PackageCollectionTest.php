<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Shipment\Package;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;

class PackageCollectionTest extends TestCase
{
    public function testJson()
    {
        $packageCollection = PackageCollection::fromJson($this->getPackageSetJson());
        self::assertEquals($this->getPackageSetJson(), $packageCollection->toJson());
    }

    public function testWithers()
    {
        $packageSet = PackageCollection::create()
            ->with(Package::create())
            ->with(Package::create())
            ->with(Package::create())
            ->with(Package::create());

        self::assertTrue(PackageCollection::fromJson($this->getPackageSetJson())->equals($packageSet));
    }

    public function testEquals()
    {
        $packageSet = PackageCollection::fromJson($this->getPackageSetJson());
        $otherPackageSet = PackageCollection::fromJson($this->getPackageSetJson());

        self::assertTrue($packageSet->equals($otherPackageSet));
        $packageSet = $packageSet->with(Package::create());
        self::assertFalse($packageSet->equals($otherPackageSet));
    }

    public function getPackageSetJson()
    {
        return [
            [
                "extension_attributes" => [],
            ],
            [
                "extension_attributes" => [],
            ],
            [
                "extension_attributes" => [],
            ],
            [
                "extension_attributes" => [],
            ]
        ];
    }
}