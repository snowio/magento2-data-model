<?php
namespace SnowIO\Magento2DataModel\Test\Inventory;

use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Inventory\SourceItemData;
use SnowIO\Magento2DataModel\Inventory\SourceItemDataSet;

abstract class SourceItemHelpers
{
    public static function getSourceItems(): SourceItemDataSet
    {
        return SourceItemDataSet::of([
            self::getSourceItem('A', 'B'),
            self::getSourceItem('C', 'D')
        ]);
    }

    public static function getSourceItemsJson(): array
    {
        return [
            self::getSourceItemJson('A', "B"),
            self::getSourceItemJson('C', 'D'),
        ];
    }

    public static function getSourceItem($sku, $sourceCode, $quantity = 10, $status = 'test'): SourceItemData
    {
        return SourceItemData::of($sku, $sourceCode)
            ->withQuantity($quantity)
            ->withStatus($status)
            ->withExtensionAttribute(ExtensionAttribute::of('foo', 'bar'));
    }

    public static function getSourceItemJson($sku, $sourceCode, $quantity = 10, $status = 'test')
    {
        return [
            'sku' => $sku,
            'source_code' => $sourceCode,
            'quantity' => $quantity,
            'status' => $status,
            'extension_attributes' => [
                'foo' => 'bar'
            ]
        ];
    }
}
