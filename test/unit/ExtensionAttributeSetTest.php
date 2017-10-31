<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\AttributeSetCode;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

class ExtensionAttributeSetTest extends TestCase
{

    public function testToJson()
    {
        $extensionAttributeSet = ExtensionAttributeSet::of([
            AttributeSetCode::of('default'),
            $this->createStockExtensionAttribute(100, 1000)
        ]);

        self::assertEquals([
            'attribute_set_code' => 'default',
            'stock' => [
                'internal_amount' => 100,
                'warehouse_amount' => 1000,
            ]
        ], $extensionAttributeSet->toJson());
    }

    public function testWitherToSet()
    {
        $extensionAttributeSet = ExtensionAttributeSet::create();

        self::assertTrue($extensionAttributeSet->isEmpty());

        $extensionAttributeSet = $extensionAttributeSet
            ->withExtensionAttribute($this->createStockExtensionAttribute(100, 1000))
            ->withExtensionAttribute($this->createSupplierReferenceExtensionAttribute(5897343));

        self::assertEquals(2, $extensionAttributeSet->count());

        $extensionAttributeSet = $extensionAttributeSet
            ->withExtensionAttribute(AttributeSetCode::of('general'))
            ->withExtensionAttribute($this->createSupplierReferenceExtensionAttribute(5897843));

        $expectedExtensionAttributeSet = ExtensionAttributeSet::of([
            AttributeSetCode::of('general'),
            $this->createStockExtensionAttribute(100, 1000),
            $this->createSupplierReferenceExtensionAttribute(5897843),
        ]);

        self::assertTrue($expectedExtensionAttributeSet->equals($extensionAttributeSet));

    }

    public function testEquality()
    {
        $expectedExtensionAttributeSet = ExtensionAttributeSet::of([
            AttributeSetCode::of('general'),
            $this->createStockExtensionAttribute(100, 1000),
            $this->createSupplierReferenceExtensionAttribute(5897843),
        ]);

        $sameExtensionAttributeSet = ExtensionAttributeSet::of([
            AttributeSetCode::of('general'),
            $this->createStockExtensionAttribute(100, 1000),
            $this->createSupplierReferenceExtensionAttribute(5897843),
        ]);

        $differentExtensionAttributeSet = ExtensionAttributeSet::of([
            AttributeSetCode::of('general'),
            $this->createStockExtensionAttribute(100, 1001),
            $this->createSupplierReferenceExtensionAttribute(5897843),
        ]);

        self::assertTrue($expectedExtensionAttributeSet->equals($sameExtensionAttributeSet));
        self::assertFalse($expectedExtensionAttributeSet->equals($differentExtensionAttributeSet));
    }

    private function createStockExtensionAttribute(int $internalAmount, int $warehouseAmount)
    {
        return StockItem::of($internalAmount, $warehouseAmount);
    }

    private function createSupplierReferenceExtensionAttribute(int $referenceNumber)
    {
        return SupplierReference::of($referenceNumber);
    }
}
