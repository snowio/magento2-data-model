<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\ItemData;
use SnowIO\Magento2DataModel\Order\ProductOptionData;
use SnowIO\Magento2DataModel\Order\StatusHistoryData;
use SnowIO\Magento2DataModel\Test\Order\ProductOptionDataTest;

class ItemDataTest extends TestCase
{

    public function testToJson()
    {
        $item = self::getItem();
        self::assertEquals(self::getItemJson(), $item->toJson());
    }

    public function testFromJson()
    {
        $item = ItemData::fromJson(self::getItemJson());
        self::assertEquals("string", $item->getAdditionalData());
        self::assertEquals("0", $item->getAmountRefunded());
        self::assertEquals("string", $item->getAppliedRuleIds());
        self::assertEquals("0", $item->getBaseAmountRefunded());
        self::assertEquals("0", $item->getBaseCost());
        self::assertEquals("0", $item->getBaseDiscountAmount());
        self::assertEquals("0", $item->getBaseDiscountInvoiced());
        self::assertEquals("0", $item->getBaseDiscountRefunded());
        self::assertEquals("0", $item->getBaseDiscountTaxCompensationAmount());
        self::assertEquals("0", $item->getBaseDiscountTaxCompensationInvoiced());
        self::assertEquals("0", $item->getBaseDiscountTaxCompensationRefunded());
        self::assertEquals("0", $item->getBaseOriginalPrice());
        self::assertEquals("0", $item->getBasePrice());
        self::assertEquals("0", $item->getBasePriceInclTax());
        self::assertEquals("0", $item->getBaseRowInvoiced());
        self::assertEquals("0", $item->getBaseRowTotal());
        self::assertEquals("0", $item->getBaseRowTotalInclTax());
        self::assertEquals("0", $item->getBaseTaxAmount());
        self::assertEquals("0", $item->getBaseTaxBeforeDiscount());
        self::assertEquals("0", $item->getBaseTaxInvoiced());
        self::assertEquals("0", $item->getBaseTaxRefunded());
        self::assertEquals("0", $item->getBaseWeeeTaxAppliedAmount());
        self::assertEquals("0", $item->getBaseWeeeTaxAppliedRowAmnt());
        self::assertEquals("0", $item->getBaseWeeeTaxDisposition());
        self::assertEquals("0", $item->getBaseWeeeTaxRowDisposition());
        self::assertEquals("string", $item->getCreatedAt());
        self::assertEquals("string", $item->getDescription());
        self::assertEquals("0", $item->getDiscountAmount());
        self::assertEquals("0", $item->getDiscountInvoiced());
        self::assertEquals("0", $item->getDiscountPercent());
        self::assertEquals("0", $item->getDiscountRefunded());
        self::assertEquals(100, $item->getEventId());
        self::assertEquals("string", $item->getExtOrderItemId());
        self::assertEquals(1, $item->getFreeShipping());
        self::assertEquals("0", $item->getGwBasePrice());
        self::assertEquals("0", $item->getGwBasePriceInvoiced());
        self::assertEquals("0", $item->getGwBasePriceRefunded());
        self::assertEquals("0", $item->getGwBaseTaxAmount());
        self::assertEquals("0", $item->getGwBaseTaxAmountInvoiced());
        self::assertEquals("0", $item->getGwBaseTaxAmountRefunded());
        self::assertEquals(0, $item->getGwId());
        self::assertEquals("0", $item->getGwPrice());
        self::assertEquals("0", $item->getGwPriceInvoiced());
        self::assertEquals("0", $item->getGwPriceRefunded());
        self::assertEquals("0", $item->getGwTaxAmount());
        self::assertEquals("0", $item->getGwTaxAmountInvoiced());
        self::assertEquals("0", $item->getGwTaxAmountRefunded());
        self::assertEquals("0", $item->getDiscountTaxCompensationAmount());
        self::assertEquals("0", $item->getDiscountTaxCompensationCanceled());
        self::assertEquals("0", $item->getDiscountTaxCompensationInvoiced());
        self::assertEquals("0", $item->getDiscountTaxCompensationRefunded());
        self::assertEquals(1, $item->getIsQtyDecimal());
        self::assertEquals(0, $item->getIsVirtual());
        self::assertEquals(100, $item->getItemId());
        self::assertEquals(1, $item->getLockedDoInvoice());
        self::assertEquals(1, $item->getLockedDoShip());
        self::assertEquals("string", $item->getName());
        self::assertEquals(0, $item->getNoDiscount());
        self::assertEquals(10, $item->getOrderId());
        self::assertEquals("0", $item->getOriginalPrice());
        self::assertEquals(10, $item->getParentItemId());
        self::assertEquals("0", $item->getPrice());
        self::assertEquals("0", $item->getPriceInclTax());
        self::assertEquals(10, $item->getProductId());
        self::assertEquals("string", $item->getProductType());
        self::assertEquals("0", $item->getQtyBackordered());
        self::assertEquals("0", $item->getQtyCanceled());
        self::assertEquals("0", $item->getQtyInvoiced());
        self::assertEquals("0", $item->getQtyOrdered());
        self::assertEquals("0", $item->getQtyRefunded());
        self::assertEquals("0", $item->getQtyReturned());
        self::assertEquals("0", $item->getQtyShipped());
        self::assertEquals(0, $item->getQuoteItemId());
        self::assertEquals("0", $item->getRowInvoiced());
        self::assertEquals("0", $item->getRowTotal());
        self::assertEquals("0", $item->getRowTotalInclTax());
        self::assertEquals("0", $item->getRowWeight());
        self::assertEquals("string", $item->getSku());
        self::assertEquals(0, $item->getStoreId());
        self::assertEquals("0", $item->getTaxAmount());
        self::assertEquals("0", $item->getTaxBeforeDiscount());
        self::assertEquals("0", $item->getTaxCanceled());
        self::assertEquals("0", $item->getTaxInvoiced());
        self::assertEquals("0", $item->getTaxPercent());
        self::assertEquals("0", $item->getTaxRefunded());
        self::assertEquals("string", $item->getUpdatedAt());
        self::assertEquals("string", $item->getWeeeTaxApplied());
        self::assertEquals("0", $item->getWeeeTaxAppliedAmount());
        self::assertEquals("0", $item->getWeeeTaxAppliedRowAmount());
        self::assertEquals("0", $item->getWeeeTaxDisposition());
        self::assertEquals("0", $item->getWeeeTaxRowDisposition());
        self::assertEquals("0", $item->getWeight());
        self::assertEquals(null, $item->getParentItem());
        self::assertTrue(
            ProductOptionData::create()
                ->withExtensionAttributes(ExtensionAttributeSet::of([
                    ExtensionAttribute::of('attribute_set_code', 'general'),
                ]))->equals($item->getProductOption())
        );
        self::assertTrue(ExtensionAttributeSet::create()->equals($item->getExtensionAttributes()));
    }

    public function testEquals()
    {
        $item = self::getItem();
        $otherItem = self::getItem();
        self::assertTrue($item->equals($otherItem));
        self::assertFalse(($item->withFreeShipping(0))->equals($otherItem));
        self::assertFalse($item->equals(StatusHistoryData::of(3, 'foo', 2)));
    }

    public static function getItemJson(): array
    {
        return [
            "additional_data" => "string",
            "amount_refunded" => "0",
            "applied_rule_ids" => "string",
            "base_amount_refunded" => "0",
            "base_cost" => "0",
            "base_discount_amount" => "0",
            "base_discount_invoiced" => "0",
            "base_discount_refunded" => "0",
            "base_discount_tax_compensation_amount" => "0",
            "base_discount_tax_compensation_invoiced" => "0",
            "base_discount_tax_compensation_refunded" => "0",
            "base_original_price" => "0",
            "base_price" => "0",
            "base_price_incl_tax" => "0",
            "base_row_invoiced" => "0",
            "base_row_total" => "0",
            "base_row_total_incl_tax" => "0",
            "base_tax_amount" => "0",
            "base_tax_before_discount" => "0",
            "base_tax_invoiced" => "0",
            "base_tax_refunded" => "0",
            "base_weee_tax_applied_amount" => "0",
            "base_weee_tax_applied_row_amnt" => "0",
            "base_weee_tax_disposition" => "0",
            "base_weee_tax_row_disposition" => "0",
            "created_at" => "string",
            "description" => "string",
            "discount_amount" => "0",
            "discount_invoiced" => "0",
            "discount_percent" => "0",
            "discount_refunded" => "0",
            "event_id" => 100,
            "ext_order_item_id" => "string",
            "free_shipping" => 1,
            "gw_base_price" => "0",
            "gw_base_price_invoiced" => "0",
            "gw_base_price_refunded" => "0",
            "gw_base_tax_amount" => "0",
            "gw_base_tax_amount_invoiced" => "0",
            "gw_base_tax_amount_refunded" => "0",
            "gw_id" => 0,
            "gw_price" => "0",
            "gw_price_invoiced" => "0",
            "gw_price_refunded" => "0",
            "gw_tax_amount" => "0",
            "gw_tax_amount_invoiced" => "0",
            "gw_tax_amount_refunded" => "0",
            "discount_tax_compensation_amount" => "0",
            "discount_tax_compensation_canceled" => "0",
            "discount_tax_compensation_invoiced" => "0",
            "discount_tax_compensation_refunded" => "0",
            "is_qty_decimal" => 1,
            "is_virtual" => 0,
            "item_id" => 100,
            "locked_do_invoice" => 1,
            "locked_do_ship" => 1,
            "name" => "string",
            "no_discount" => 0,
            "order_id" => 10,
            "original_price" => "0",
            "parent_item_id" => 10,
            "price" => "0",
            "price_incl_tax" => "0",
            "product_id" => 10,
            "product_type" => "string",
            "qty_backordered" => "0",
            "qty_canceled" => "0",
            "qty_invoiced" => "0",
            "qty_ordered" => "0",
            "qty_refunded" => "0",
            "qty_returned" => "0",
            "qty_shipped" => "0",
            "quote_item_id" => 0,
            "row_invoiced" => "0",
            "row_total" => "0",
            "row_total_incl_tax" => "0",
            "row_weight" => "0",
            "sku" => "string",
            "store_id" => 0,
            "tax_amount" => "0",
            "tax_before_discount" => "0",
            "tax_canceled" => "0",
            "tax_invoiced" => "0",
            "tax_percent" => "0",
            "tax_refunded" => "0",
            "updated_at" => "string",
            "weee_tax_applied" => "string",
            "weee_tax_applied_amount" => "0",
            "weee_tax_applied_row_amount" => "0",
            "weee_tax_disposition" => "0",
            "weee_tax_row_disposition" => "0",
            "weight" => "0",
            "parent_item" => [],
            "product_option" => ProductOptionDataTest::getProductOptionJson(),
            "extension_attributes" => []
        ];
    }

    public static function getItem(): ItemData
    {
        return ItemData::of('string')
            ->withAdditionalData("string")
            ->withAmountRefunded("0")
            ->withAppliedRuleIds("string")
            ->withBaseAmountRefunded("0")
            ->withBaseCost("0")
            ->withBaseDiscountAmount("0")
            ->withBaseDiscountInvoiced("0")
            ->withBaseDiscountRefunded("0")
            ->withBaseDiscountTaxCompensationAmount("0")
            ->withBaseDiscountTaxCompensationInvoiced("0")
            ->withBaseDiscountTaxCompensationRefunded("0")
            ->withBaseOriginalPrice("0")
            ->withBasePrice("0")
            ->withBasePriceInclTax("0")
            ->withBaseRowInvoiced("0")
            ->withBaseRowTotal("0")
            ->withBaseRowTotalInclTax("0")
            ->withBaseTaxAmount("0")
            ->withBaseTaxBeforeDiscount("0")
            ->withBaseTaxInvoiced("0")
            ->withBaseTaxRefunded("0")
            ->withBaseWeeeTaxAppliedAmount("0")
            ->withBaseWeeeTaxAppliedRowAmnt("0")
            ->withBaseWeeeTaxDisposition("0")
            ->withBaseWeeeTaxRowDisposition("0")
            ->withCreatedAt("string")
            ->withDescription("string")
            ->withDiscountAmount("0")
            ->withDiscountInvoiced("0")
            ->withDiscountPercent("0")
            ->withDiscountRefunded("0")
            ->withProductOption(ProductOptionDataTest::getProductOption())
            ->withEventId(100)
            ->withExtOrderItemId("string")
            ->withFreeShipping(1)
            ->withGwBasePrice("0")
            ->withGwBasePriceInvoiced("0")
            ->withGwBasePriceRefunded("0")
            ->withGwBaseTaxAmount("0")
            ->withGwBaseTaxAmountInvoiced("0")
            ->withGwBaseTaxAmountRefunded("0")
            ->withGwId(0)
            ->withGwPrice("0")
            ->withGwPriceInvoiced("0")
            ->withGwPriceRefunded("0")
            ->withGwTaxAmount("0")
            ->withGwTaxAmountInvoiced("0")
            ->withGwTaxAmountRefunded("0")
            ->withDiscountTaxCompensationAmount("0")
            ->withDiscountTaxCompensationCanceled("0")
            ->withDiscountTaxCompensationInvoiced("0")
            ->withDiscountTaxCompensationRefunded("0")
            ->withIsQtyDecimal(1)
            ->withIsVirtual(0)
            ->withItemId(100)
            ->withLockedDoInvoice(1)
            ->withLockedDoShip(1)
            ->withName("string")
            ->withNoDiscount(0)
            ->withOrderId(10)
            ->withOriginalPrice("0")
            ->withParentItemId(10)
            ->withPrice("0")
            ->withPriceInclTax("0")
            ->withProductId(10)
            ->withProductType("string")
            ->withQtyBackordered("0")
            ->withQtyCanceled("0")
            ->withQtyInvoiced("0")
            ->withQtyOrdered("0")
            ->withQtyRefunded("0")
            ->withQtyReturned("0")
            ->withQtyShipped("0")
            ->withQuoteItemId(0)
            ->withRowInvoiced("0")
            ->withRowTotal("0")
            ->withRowTotalInclTax("0")
            ->withRowWeight("0")
            ->withStoreId(0)
            ->withTaxAmount("0")
            ->withTaxBeforeDiscount("0")
            ->withTaxCanceled("0")
            ->withTaxInvoiced("0")
            ->withTaxPercent("0")
            ->withTaxRefunded("0")
            ->withUpdatedAt("string")
            ->withWeeeTaxApplied("string")
            ->withWeeeTaxAppliedAmount("0")
            ->withWeeeTaxAppliedRowAmount("0")
            ->withWeeeTaxDisposition("0")
            ->withWeeeTaxRowDisposition("0")
            ->withWeight("0");
    }
}
