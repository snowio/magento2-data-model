<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Arguments;

class ArgumentTest extends TestCase
{
    public function testJson()
    {
        $argument = Arguments::fromJson($this->getArgumentJson());
        self::assertEquals($this->getArgumentJson(), $argument->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getArgumentJson();
        $itemData = Arguments::fromJson($json);
        self::assertTrue(
            $itemData->getExtensionAttributes()
            ->equals(ExtensionAttributeSet::fromJson($json['extension_attributes']))
        );
    }

    public function testEquals()
    {
        $argument = Arguments::fromJson($this->getArgumentJson());
        $otherArgument = Arguments::fromJson($this->getArgumentJson());
        self::assertTrue($argument->equals($otherArgument));
        $otherArgument = $otherArgument->withExtensionAttributes(
            ExtensionAttributeSet::of([ExtensionAttribute::of('foo', 'bar')])
        );
        self::assertFalse($argument->equals($otherArgument));
    }

    public function testWitherToSet()
    {
        $json = $this->getArgumentJson();
        $json["extension_attributes"] = ['foo' => 'bar'];
        $argumentData = Arguments::create()
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('foo', 'bar')
            ]));
        self::assertTrue($argumentData->equals(Arguments::fromJson($json)));
    }

    private function getArgumentJson()
    {
        return [
            "extension_attributes" => [],
        ];
    }
}