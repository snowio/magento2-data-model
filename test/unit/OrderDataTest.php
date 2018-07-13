<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\ItemDataCollection;
use SnowIO\Magento2DataModel\Order\StatusHistoryDataCollection;
use SnowIO\Magento2DataModel\OrderData;
use SnowIO\Magento2DataModel\Test\Order\AddressDataTest;
use SnowIO\Magento2DataModel\Test\Order\PaymentDataTest;
use SnowIO\Magento2DataModel\Test\Order\StatusHistoryDataTest;

class OrderDataTest extends TestCase
{
    public function testToJson()
    {
        $order = self::getOrder();
        self::assertEquals(self::getOrderJson(), $order->toJson());
    }

    public function testFromJson()
    {
        $order = OrderData::fromJson($this->getOrderJson());
        self::assertEquals("", $order->getAdjustmentNegative());
        self::assertEquals("4", $order->getAdjustmentPositive());
        self::assertEquals("48,434,4363", $order->getAppliedRuleIds());
        self::assertEquals("5", $order->getBaseAdjustmentNegative());
        self::assertEquals("6", $order->getBaseAdjustmentPositive());
        self::assertEquals("GBP", $order->getBaseCurrencyCode());
        self::assertEquals("10.65", $order->getBaseDiscountAmount());
        self::assertEquals("5.90", $order->getBaseDiscountCanceled());
        self::assertEquals("8.96", $order->getBaseDiscountInvoiced());
        self::assertEquals("0.47", $order->getBaseDiscountRefunded());
        self::assertEquals("21.47", $order->getBaseGrandTotal());
        self::assertEquals("10.378", $order->getBaseDiscountTaxCompensationAmount());
        self::assertEquals("78.289", $order->getBaseDiscountTaxCompensationInvoiced());
        self::assertEquals("37.32", $order->getBaseDiscountTaxCompensationRefunded());
        self::assertEquals("10.89", $order->getBaseShippingAmount());
        self::assertEquals("93.48", $order->getBaseShippingCanceled());
        self::assertEquals("78.4", $order->getBaseShippingDiscountAmount());
        self::assertEquals("0.32", $order->getBaseShippingDiscountTaxCompensationAmnt());
        self::assertEquals("0.347", $order->getBaseShippingInclTax());
        self::assertEquals("0.1893", $order->getBaseShippingInvoiced());
        self::assertEquals("0.4827", $order->getBaseShippingRefunded());
        self::assertEquals("1.389", $order->getBaseShippingTaxAmount());
        self::assertEquals("3.342", $order->getBaseShippingTaxRefunded());
        self::assertEquals("4.5178", $order->getBaseSubtotal());
        self::assertEquals("10.482", $order->getBaseSubtotalCanceled());
        self::assertEquals("4.1389", $order->getBaseSubtotalInclTax());
        self::assertEquals("12.487", $order->getBaseSubtotalInvoiced());
        self::assertEquals("4.4429", $order->getBaseSubtotalRefunded());
        self::assertEquals("8.489", $order->getBaseTaxAmount());
        self::assertEquals("5.578", $order->getBaseTaxCanceled());
        self::assertEquals("8.48", $order->getBaseTaxInvoiced());
        self::assertEquals("9.587", $order->getBaseTaxRefunded());
        self::assertEquals("4.895", $order->getBaseTotalCanceled());
        self::assertEquals("4.890", $order->getBaseTotalDue());
        self::assertEquals("10.783", $order->getBaseTotalInvoiced());
        self::assertEquals("50.289", $order->getBaseTotalInvoicedCost());
        self::assertEquals("23.387", $order->getBaseTotalOfflineRefunded());
        self::assertEquals("38.478", $order->getBaseTotalOnlineRefunded());
        self::assertEquals("32.393", $order->getBaseTotalPaid());
        self::assertEquals("100", $order->getBaseTotalQtyOrdered());
        self::assertEquals("94.43", $order->getBaseTotalRefunded());
        self::assertEquals("89.48", $order->getBaseToGlobalRate());
        self::assertEquals("10.478", $order->getBaseToOrderRate());
        self::assertEquals(35, $order->getBillingAddressId());
        self::assertEquals(1, $order->canShipPartially());
        self::assertEquals(1, $order->canShipPartiallyItem());
        self::assertEquals("329hr8943h3", $order->getCouponCode());
        self::assertEquals("2017-03-21 13:55:07", $order->getCreatedAt());
        self::assertEquals("1993-02-11", $order->getCustomerDob());
        self::assertEquals("helham@test.com", $order->getCustomerEmail());
        self::assertEquals("Ben", $order->getCustomerFirstname());
        self::assertEquals(1, $order->getCustomerGender());
        self::assertEquals("5", $order->getCustomerGroupId());
        self::assertEquals("1006", $order->getCustomerId());
        self::assertEquals(0, $order->customerIsGuest());
        self::assertEquals("Helham", $order->getCustomerLastname());
        self::assertEquals("Stevenson", $order->getCustomerMiddlename());
        self::assertEquals("This is a test order", $order->getCustomerNote());
        self::assertEquals(1, $order->getCustomerNoteNotify());
        self::assertEquals("Sir", $order->getCustomerPrefix());
        self::assertEquals("PhD", $order->getCustomerSuffix());
        self::assertEquals("foo-bar", $order->getCustomerTaxvat());
        self::assertEquals("28.00", $order->getDiscountAmount());
        self::assertEquals("3.89", $order->getDiscountCanceled());
        self::assertEquals("You family!", $order->getDiscountDescription());
        self::assertEquals("78.378", $order->getDiscountInvoiced());
        self::assertEquals("76.893", $order->getDiscountRefunded());
        self::assertEquals(1, $order->getEditIncrement());
        self::assertEquals(1, $order->getEmailSent());
        self::assertEquals("809", $order->getEntityId());
        self::assertEquals("web-customer-032089283", $order->getExtCustomerId());
        self::assertEquals("web-order-9833479223", $order->getExtOrderId());
        self::assertEquals(0, $order->getForcedShipmentWithInvoice());
        self::assertEquals("GBP", $order->getGlobalCurrencyCode());
        self::assertEquals("100.032", $order->getGrandTotal());
        self::assertEquals("10.32", $order->getDiscountTaxCompensationAmount());
        self::assertEquals("80.48", $order->getDiscountTaxCompensationInvoiced());
        self::assertEquals("90.42", $order->getDiscountTaxCompensationRefunded());
        self::assertEquals("pending", $order->getHoldBeforeState());
        self::assertEquals("Pending", $order->getHoldBeforeStatus());
        self::assertEquals("1003892", $order->getIncrementId());
        self::assertEquals(0, $order->getIsVirtual());
        self::assertEquals("GBP", $order->getOrderCurrencyCode());
        self::assertEquals("1003891", $order->getOriginalIncrementId());
        self::assertEquals("100.9", $order->getPaymentAuthorizationAmount());
        self::assertEquals(1671675566, $order->getPaymentAuthExpiration());
        self::assertEquals("HI78YU", $order->getProtectCode());
        self::assertEquals("21", $order->getQuoteAddressId());
        self::assertEquals("23", $order->getQuoteId());
        self::assertEquals("TestChildRelation", $order->getRelationChildId());
        self::assertEquals("8392UIH", $order->getRelationChildRealId());
        self::assertEquals("TestParentRelation", $order->getRelationParentId());
        self::assertEquals("8392UIJ", $order->getRelationParentRealId());
        self::assertEquals("123.198.0.9", $order->getRemoteIp());
        self::assertEquals("10.0", $order->getShippingAmount());
        self::assertEquals("2.0", $order->getShippingCanceled());
        self::assertEquals("Foo bar", $order->getShippingDescription());
        self::assertEquals("30.9", $order->getShippingDiscountAmount());
        self::assertEquals("10.8", $order->getShippingDiscountTaxCompensationAmount());
        self::assertEquals("10.9", $order->getShippingInclTax());
        self::assertEquals("7.9", $order->getShippingInvoiced());
        self::assertEquals("9.8", $order->getShippingRefunded());
        self::assertEquals("4.67", $order->getShippingTaxAmount());
        self::assertEquals("10.8", $order->getShippingTaxRefunded());
        self::assertEquals("processing", $order->getState());
        self::assertEquals("processing", $order->getStatus());
        self::assertEquals("EUR", $order->getStoreCurrencyCode());
        self::assertEquals("101", $order->getStoreId());
        self::assertEquals("Testing tools", $order->getStoreName());
        self::assertEquals("1.09", $order->getStoreToBaseRate());
        self::assertEquals("1.01", $order->getStoreToOrderRate());
        self::assertEquals("1000.00", $order->getSubtotal());
        self::assertEquals("10.9", $order->getSubtotalCanceled());
        self::assertEquals("1.87", $order->getSubtotalInclTax());
        self::assertEquals("7.89", $order->getSubtotalInvoiced());
        self::assertEquals("9.80", $order->getSubtotalRefunded());
        self::assertEquals("30.9", $order->getTaxAmount());
        self::assertEquals("70.1", $order->getTaxCanceled());
        self::assertEquals("6.1", $order->getTaxInvoiced());
        self::assertEquals("8.9", $order->getTaxRefunded());
        self::assertEquals("7.9", $order->getTotalCanceled());
        self::assertEquals("10.6", $order->getTotalDue());
        self::assertEquals("30.90", $order->getTotalInvoiced());
        self::assertEquals(4, $order->getTotalItemCount());
        self::assertEquals("36.9", $order->getTotalOfflineRefunded());
        self::assertEquals("78.9", $order->getTotalOnlineRefunded());
        self::assertEquals("30.8", $order->getTotalPaid());
        self::assertEquals("6", $order->getTotalQtyOrdered());
        self::assertEquals("10", $order->getTotalRefunded());
        self::assertEquals("2017-03-21 13:55:07", $order->getUpdatedAt());
        self::assertEquals("189.2", $order->getWeight());
        self::assertEquals("foo-bar", $order->getXForwardedFor());
        self::assertEquals(ItemDataCollection::of([ItemDataTest::getItem()])->toJson(), $order->getItems()->toJson());
        self::assertTrue(ItemDataCollection::of([ItemDataTest::getItem()])->equals($order->getItems()));
        self::assertTrue(AddressDataTest::getAddress()->equals($order->getBillingAddress()));
        self::assertTrue((PaymentDataTest::getPayment())->equals($order->getPayment()));
    }

    public function testEquals()
    {
        $order = OrderData::fromJson($this->getOrderJson());
        $otherOrder = OrderData::fromJson($this->getOrderJson());
        self::assertTrue($order->equals($otherOrder));
        $otherOrder = $otherOrder->withStatus('changed');
        self::assertFalse($order->equals($otherOrder));
        //change payment data in order
        $otherOrder = OrderData::fromJson($this->getOrderJson());
        $otherOrder = $otherOrder->withPayment($otherOrder->getPayment()->withEntityId("389"));
        self::assertFalse($order->equals($otherOrder));
    }

    public function getOrder()
    {
        return  OrderData::of("helham@test.com", "21.47", "100.032")
            ->withAdjustmentPositive("4")
            ->withAppliedRuleIds("48,434,4363")
            ->withBaseAdjustmentNegative("5")
            ->withBaseAdjustmentPositive("6")
            ->withBaseCurrencyCode("GBP")
            ->withBaseDiscountAmount("10.65")
            ->withBaseDiscountCanceled("5.90")
            ->withBaseDiscountInvoiced("8.96")
            ->withBaseDiscountRefunded("0.47")
            ->withBaseDiscountTaxCompensationAmount("10.378")
            ->withBaseDiscountTaxCompensationInvoiced("78.289")
            ->withBaseDiscountTaxCompensationRefunded("37.32")
            ->withBaseShippingAmount("10.89")
            ->withBaseShippingCanceled("93.48")
            ->withBaseShippingDiscountAmount("78.4")
            ->withBaseShippingDiscountTaxCompensationAmnt("0.32")
            ->withBaseShippingInclTax("0.347")
            ->withBaseShippingInvoiced("0.1893")
            ->withBaseShippingRefunded("0.4827")
            ->withBaseShippingTaxAmount("1.389")
            ->withBaseShippingTaxRefunded("3.342")
            ->withBaseSubtotal("4.5178")
            ->withBaseSubtotalCanceled("10.482")
            ->withBaseSubtotalInclTax("4.1389")
            ->withBaseSubtotalInvoiced("12.487")
            ->withBaseSubtotalRefunded("4.4429")
            ->withBaseTaxAmount("8.489")
            ->withBaseTaxCanceled("5.578")
            ->withBaseTaxInvoiced("8.48")
            ->withBaseTaxRefunded("9.587")
            ->withBaseTotalCanceled("4.895")
            ->withBaseTotalDue("4.890")
            ->withBaseTotalInvoiced("10.783")
            ->withBaseTotalInvoicedCost("50.289")
            ->withBaseTotalOfflineRefunded("23.387")
            ->withBaseTotalOnlineRefunded("38.478")
            ->withBaseTotalPaid("32.393")
            ->withBaseTotalQtyOrdered("100")
            ->withBaseTotalRefunded("94.43")
            ->withBaseToGlobalRate("89.48")
            ->withBaseToOrderRate("10.478")
            ->withBillingAddressId("35")
            ->withCanShipPartially(1)
            ->withCanShipPartiallyItem(1)
            ->withCouponCode("329hr8943h3")
            ->withCreatedAt("2017-03-21 13:55:07")
            ->withCustomerDob("1993-02-11")
            ->withCustomerEmail("helham@test.com")
            ->withCustomerFirstname("Ben")
            ->withCustomerGender(1)
            ->withCustomerGroupId("5")
            ->withCustomerId("1006")
            ->withCustomerIsGuest(0)
            ->withCustomerLastname("Helham")
            ->withCustomerMiddlename("Stevenson")
            ->withCustomerNote("This is a test order")
            ->withCustomerNoteNotify(1)
            ->withCustomerPrefix("Sir")
            ->withCustomerSuffix("PhD")
            ->withCustomerTaxvat("foo-bar")
            ->withDiscountAmount("28.00")
            ->withDiscountCanceled("3.89")
            ->withDiscountDescription("You family!")
            ->withDiscountInvoiced("78.378")
            ->withDiscountRefunded("76.893")
            ->withEditIncrement(1)
            ->withEmailSent(1)
            ->withEntityId("809")
            ->withExtCustomerId("web-customer-032089283")
            ->withExtOrderId("web-order-9833479223")
            ->withForcedShipmentWithInvoice(0)
            ->withGlobalCurrencyCode("GBP")
            ->withDiscountTaxCompensationAmount("10.32")
            ->withDiscountTaxCompensationInvoiced("80.48")
            ->withDiscountTaxCompensationRefunded("90.42")
            ->withHoldBeforeState("pending")
            ->withHoldBeforeStatus("Pending")
            ->withIncrementId("1003892")
            ->withIsVirtual(0)
            ->withOrderCurrencyCode("GBP")
            ->withOriginalIncrementId("1003891")
            ->withPaymentAuthorizationAmount("100.9")
            ->withPaymentAuthExpiration(1671675566)
            ->withProtectCode("HI78YU")
            ->withQuoteAddressId("21")
            ->withQuoteId("23")
            ->withItems(ItemDataCollection::of([ItemDataTest::getItem()]))
            ->withRelationChildId("TestChildRelation")
            ->withRelationChildRealId("8392UIH")
            ->withRelationParentId("TestParentRelation")
            ->withRelationParentRealId("8392UIJ")
            ->withRemoteIp("123.198.0.9")
            ->withShippingAmount("10.0")
            ->withShippingCanceled("2.0")
            ->withShippingDescription("Foo bar")
            ->withShippingDiscountAmount("30.9")
            ->withShippingDiscountTaxCompensationAmount("10.8")
            ->withShippingInclTax("10.9")
            ->withShippingInvoiced("7.9")
            ->withShippingRefunded("9.8")
            ->withShippingTaxAmount("4.67")
            ->withShippingTaxRefunded("10.8")
            ->withState("processing")
            ->withStatus("processing")
            ->withStoreCurrencyCode("EUR")
            ->withStoreId("101")
            ->withStoreName("Testing tools")
            ->withStoreToBaseRate("1.09")
            ->withStoreToOrderRate("1.01")
            ->withSubtotal("1000.00")
            ->withSubtotalCanceled("10.9")
            ->withSubtotalInclTax("1.87")
            ->withSubtotalInvoiced("7.89")
            ->withSubtotalRefunded("9.80")
            ->withTaxAmount("30.9")
            ->withTaxCanceled("70.1")
            ->withTaxInvoiced("6.1")
            ->withTaxRefunded("8.9")
            ->withTotalCanceled("7.9")
            ->withTotalDue("10.6")
            ->withTotalInvoiced("30.90")
            ->withTotalItemCount(4)
            ->withTotalOfflineRefunded("36.9")
            ->withTotalOnlineRefunded("78.9")
            ->withTotalPaid("30.8")
            ->withTotalQtyOrdered("6")
            ->withTotalRefunded("10")
            ->withUpdatedAt("2017-03-21 13:55:07")
            ->withWeight("189.2")
            ->withXForwardedFor("foo-bar")
            ->withPayment(PaymentDataTest::getPayment())
            ->withBillingAddress(AddressDataTest::getAddress())
            ->withStatusHistories(StatusHistoryDataCollection::of([StatusHistoryDataTest::getStatusHistory()]))
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('gw_tax_amount_refunded', 'string')
            ]));
    }

    public static function getOrderJson(): array
    {
        return [
            "adjustment_negative" => null,
            "adjustment_positive" => "4",
            "applied_rule_ids" => "48,434,4363",
            "base_adjustment_negative" => "5",
            "base_adjustment_positive" => "6",
            "base_currency_code" => "GBP",
            "base_discount_amount" => "10.65",
            "base_discount_canceled" => "5.90",
            "base_discount_invoiced" => "8.96",
            "base_discount_refunded" => "0.47",
            "base_grand_total" => "21.47",
            "base_discount_tax_compensation_amount" => "10.378",
            "base_discount_tax_compensation_invoiced" => "78.289",
            "base_discount_tax_compensation_refunded" => "37.32",
            "base_shipping_amount" => "10.89",
            "base_shipping_canceled" => "93.48",
            "base_shipping_discount_amount" => "78.4",
            "base_shipping_discount_tax_compensation_amnt" => "0.32",
            "base_shipping_incl_tax" => "0.347",
            "base_shipping_invoiced" => "0.1893",
            "base_shipping_refunded" => "0.4827",
            "base_shipping_tax_amount" => "1.389",
            "base_shipping_tax_refunded" => "3.342",
            "base_subtotal" => "4.5178",
            "base_subtotal_canceled" => "10.482",
            "base_subtotal_incl_tax" => "4.1389",
            "base_subtotal_invoiced" => "12.487",
            "base_subtotal_refunded" => "4.4429",
            "base_tax_amount" => "8.489",
            "base_tax_canceled" => "5.578",
            "base_tax_invoiced" => "8.48",
            "base_tax_refunded" => "9.587",
            "base_total_canceled" => "4.895",
            "base_total_due" => "4.890",
            "base_total_invoiced" => "10.783",
            "base_total_invoiced_cost" => "50.289",
            "base_total_offline_refunded" => "23.387",
            "base_total_online_refunded" => "38.478",
            "base_total_paid" => "32.393",
            "base_total_qty_ordered" => "100",
            "base_total_refunded" => "94.43",
            "base_to_global_rate" => "89.48",
            "base_to_order_rate" => "10.478",
            "billing_address_id" => 35,
            "can_ship_partially" => 1,
            "can_ship_partially_item" => 1,
            "coupon_code" => "329hr8943h3",
            "created_at" => "2017-03-21 13:55:07",
            "customer_dob" => "1993-02-11",
            "customer_email" => "helham@test.com",
            "customer_firstname" => "Ben",
            "customer_gender" => 1,
            "customer_group_id" => 5,
            "customer_id" => 1006,
            "customer_is_guest" => 0,
            "customer_lastname" => "Helham",
            "customer_middlename" => "Stevenson",
            "customer_note" => "This is a test order",
            "customer_note_notify" => 1,
            "customer_prefix" => "Sir",
            "customer_suffix" => "PhD",
            "customer_taxvat" => "foo-bar",
            "discount_amount" => "28.00",
            "discount_canceled" => "3.89",
            "discount_description" => "You family!",
            "discount_invoiced" => "78.378",
            "discount_refunded" => "76.893",
            "edit_increment" => 1,
            "email_sent" => 1,
            "entity_id" => 809,
            "ext_customer_id" => "web-customer-032089283",
            "ext_order_id" => "web-order-9833479223",
            "forced_shipment_with_invoice" => 0,
            "global_currency_code" => "GBP",
            "grand_total" => "100.032",
            "discount_tax_compensation_amount" => "10.32",
            "discount_tax_compensation_invoiced" => "80.48",
            "discount_tax_compensation_refunded" => "90.42",
            "hold_before_state" => "pending",
            "hold_before_status" => "Pending",
            "increment_id" => "1003892",
            "is_virtual" => 0,
            "order_currency_code" => "GBP",
            "original_increment_id" => "1003891",
            "payment_authorization_amount" => "100.9",
            "payment_auth_expiration" => 1671675566,
            "protect_code" => "HI78YU",
            "quote_address_id" => 21,
            "quote_id" => 23,
            "relation_child_id" => "TestChildRelation",
            "relation_child_real_id" => "8392UIH",
            "relation_parent_id" => "TestParentRelation",
            "relation_parent_real_id" => "8392UIJ",
            "remote_ip" => "123.198.0.9",
            "shipping_amount" => "10.0",
            "shipping_canceled" => "2.0",
            "shipping_description" => "Foo bar",
            "shipping_discount_amount" => "30.9",
            "shipping_discount_tax_compensation_amount" => "10.8",
            "shipping_incl_tax" => "10.9",
            "shipping_invoiced" => "7.9",
            "shipping_refunded" => "9.8",
            "shipping_tax_amount" => "4.67",
            "shipping_tax_refunded" => "10.8",
            "state" => "processing",
            "status" => "processing",
            "store_currency_code" => "EUR",
            "store_id" => 101,
            "store_name" => "Testing tools",
            "store_to_base_rate" => "1.09",
            "store_to_order_rate" => "1.01",
            "subtotal" => "1000.00",
            "subtotal_canceled" => "10.9",
            "subtotal_incl_tax" => "1.87",
            "subtotal_invoiced" => "7.89",
            "subtotal_refunded" => "9.80",
            "tax_amount" => "30.9",
            "tax_canceled" => "70.1",
            "tax_invoiced" => "6.1",
            "tax_refunded" => "8.9",
            "total_canceled" => "7.9",
            "total_due" => "10.6",
            "total_invoiced" => "30.90",
            "total_item_count" => 4,
            "total_offline_refunded" => "36.9",
            "total_online_refunded" => "78.9",
            "total_paid" => "30.8",
            "total_qty_ordered" => "6",
            "total_refunded" => "10",
            "updated_at" => "2017-03-21 13:55:07",
            "weight" => "189.2",
            "x_forwarded_for" => "foo-bar",
            "items" => [
                ItemDataTest::getItemJson()
            ],
            "billing_address" => AddressDataTest::getAddressJson(),
            "payment" => PaymentDataTest::getPaymentJson(),
            "status_histories" => [StatusHistoryDataTest::getStatusHistoryJson(),],
            "extension_attributes" => ['gw_tax_amount_refunded' => 'string'],
        ];
    }
}
