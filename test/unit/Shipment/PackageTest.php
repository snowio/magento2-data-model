<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Package;

class PackageTest extends TestCase
{
    public function testJson()
    {
        $package = Package::fromJson($this->getPackageJson());
        self::assertEquals($this->getPackageJson(), $package->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getPackageJson();
        $package = Package::fromJson($json);
        self::assertTrue(
            $package->getExtensionAttributes()
                ->equals(ExtensionAttributeSet::fromJson($json['extension_attributes']))
        );
    }

    public function testEquals()
    {
        $package = Package::fromJson($this->getPackageJson());
        $otherPackage = Package::fromJson($this->getPackageJson());
        self::assertTrue($package->equals($otherPackage));
        $otherPackage = $otherPackage->withExtensionAttributes(
            ExtensionAttributeSet::of([ExtensionAttribute::of('foo', 'bar')])
        );
        self::assertFalse($package->equals($otherPackage));
    }

    public function testWitherToSet()
    {
        $json = $this->getPackageJson();
        $json["extension_attributes"] = ['foo' => 'bar'];
        $packageData = Package::create()
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('foo', 'bar')
            ]));
        self::assertTrue($packageData->equals(Package::fromJson($json)));
    }

    private function getPackageJson()
    {
        return [
            "extension_attributes" => [],
        ];
    }
}