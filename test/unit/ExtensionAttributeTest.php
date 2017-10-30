<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeValue;

class ExtensionAttributeTest extends TestCase
{

    public function testToJson()
    {
        $extensionAttributeValue = $this->createExternalAttributeValue(10, 1000);
        $extensionAttribute = ExtensionAttribute::of('stock', $extensionAttributeValue);
        self::assertEquals([
            'stock' => [
                'internal_amount' => 10,
                'warehouse_amount' => 1000
            ]
        ], $extensionAttribute->toJson());
    }

    public function testAccessors()
    {
        $extensionAttributeValue = $this->createExternalAttributeValue(10, 1000);
        $extensionAttribute = ExtensionAttribute::of('stock', $extensionAttributeValue);
        self::assertEquals('stock', $extensionAttribute->getKey());
        self::assertTrue($this->createExternalAttributeValue(10, 1000)->equals($extensionAttribute->getValue()));
    }

    public function testEquals()
    {
        $extensionAttributeValue = $this->createExternalAttributeValue(10, 1000);
        $extensionAttribute = ExtensionAttribute::of('stock', $extensionAttributeValue);
        $sameValue =  $this->createExternalAttributeValue(10, 1000);
        $differentValue = $this->createExternalAttributeValue(10, 100);
        $sameExtensionAttribute = ExtensionAttribute::of('stock', $sameValue);
        self::assertTrue($extensionAttribute->equals($sameExtensionAttribute));
        self::assertFalse($extensionAttribute->equals(ExtensionAttribute::of('stock', $differentValue)));
        self::assertFalse($extensionAttribute->equals(ExtensionAttribute::of('other', $differentValue)));
        self::assertFalse($extensionAttribute->equals(CustomAttribute::of('stock', '1000')));
    }

    private function createExternalAttributeValue(int $internalAmount, int $warehouseAmount)
    {
        return new class ($internalAmount, $warehouseAmount) implements ExtensionAttributeValue {
            public function toJson(): array
            {
                return [
                    'internal_amount' => $this->internalAmount,
                    'warehouse_amount' => $this->warehouseAmount,
                ];
            }

            public function equals($value): bool
            {
                return $value instanceof self &&
                ($this->internalAmount === $value->internalAmount) &&
                ($this->warehouseAmount === $value->warehouseAmount);
            }

            private $internalAmount;
            private $warehouseAmount;

            public function __construct($internalAmount, $warehouseAmount)
            {
                $this->internalAmount = $internalAmount;
                $this->warehouseAmount = $warehouseAmount;
            }
        };
    }
}
