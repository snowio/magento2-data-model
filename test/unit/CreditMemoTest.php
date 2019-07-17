<?php

namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CreditMemoData;

class CreditMemoTest extends TestCase
{
    public function testSerialization()
    {
        $creditMemo = CreditMemoData::fromJson(self::getCreditMemoJson());
        self::assertEquals(self::getCreditMemoJson(), $creditMemo->toJson());
    }

    public function testEquals()
    {
        $creditMemo = CreditMemoData::fromJson($this->getCreditMemoJson());
        $otherCreditMemo = CreditMemoData::fromJson($this->getCreditMemoJson());
        self::assertTrue($creditMemo->equals($otherCreditMemo));
        $otherCreditMemo = $otherCreditMemo->withBaseTaxAmount('32');
        self::assertFalse($otherCreditMemo->equals($creditMemo));
    }

    public static function getCreditMemoJson(): array
    {
        return [
            "adjustment" => 0,
            "adjustment_negative" => 0,
            "adjustment_positive" => 0,
            "base_adjustment" => 0,
            "base_adjustment_negative" => 0,
            "base_adjustment_positive" => 0,
            "base_currency_code" => "string",
            "base_discount_amount" => 0,
            "base_grand_total" => 0,
            "base_discount_tax_compensation_amount" => 0,
            "base_shipping_amount" => 0,
            "base_shipping_discount_tax_compensation_amnt" => 0,
            "base_shipping_incl_tax" => 0,
            "base_shipping_tax_amount" => 0,
            "base_subtotal" => 0,
            "base_subtotal_incl_tax" => 0,
            "base_tax_amount" => 0,
            "base_to_global_rate" => 0,
            "base_to_order_rate" => 0,
            "billing_address_id" => 0,
            "created_at" => "string",
            "creditmemo_status" => 0,
            "discount_amount" => 0,
            "discount_description" => "string",
            "email_sent" => 0,
            "entity_id" => 0,
            "global_currency_code" => "string",
            "grand_total" => 0,
            "discount_tax_compensation_amount" => 0,
            "increment_id" => "string",
            "invoice_id" => 0,
            "order_currency_code" => "string",
            "order_id" => 0,
            "shipping_address_id" => 0,
            "shipping_amount" => 0,
            "shipping_discount_tax_compensation_amount" => 0,
            "shipping_incl_tax" => 0,
            "shipping_tax_amount" => 0,
            "state" => 0,
            "store_currency_code" => "string",
            "store_id" => 0,
            "store_to_base_rate" => 0,
            "store_to_order_rate" => 0,
            "subtotal" => 0,
            "subtotal_incl_tax" => 0,
            "tax_amount" => 0,
            "transaction_id" => "string",
            "updated_at" => "string",
            "items" => [
                [
                    "additional_data" => "string",
                    "base_cost" => 0,
                    "base_discount_amount" => 0,
                    "base_discount_tax_compensation_amount" => 0,
                    "base_price" => 0,
                    "base_price_incl_tax" => 0,
                    "base_row_total" => 0,
                    "base_row_total_incl_tax" => 0,
                    "base_tax_amount" => 0,
                    "base_weee_tax_applied_amount" => 0,
                    "base_weee_tax_applied_row_amnt" => 0,
                    "base_weee_tax_disposition" => 0,
                    "base_weee_tax_row_disposition" => 0,
                    "description" => "string",
                    "discount_amount" => 0,
                    "entity_id" => 0,
                    "discount_tax_compensation_amount" => 0,
                    "name" => "string",
                    "order_item_id" => 0,
                    "parent_id" => 0,
                    "price" => 0,
                    "price_incl_tax" => 0,
                    "product_id" => 0,
                    "qty" => 0,
                    "row_total" => 0,
                    "row_total_incl_tax" => 0,
                    "sku" => "string",
                    "tax_amount" => 0,
                    "weee_tax_applied" => "string",
                    "weee_tax_applied_amount" => 0,
                    "weee_tax_applied_row_amount" => 0,
                    "weee_tax_disposition" => 0,
                    "weee_tax_row_disposition" => 0,
                    "extension_attributes" => []
                ]
            ],
            "comments" => [
                [
                    "comment" => "string",
                    "created_at" => "string",
                    "entity_id" => 0,
                    "is_customer_notified" => 0,
                    "is_visible_on_front" => 0,
                    "parent_id" => 0,
                    "extension_attributes" => []
                ]
            ],
            "extension_attributes" => [
                "base_customer_balance_amount" => 0,
                "customer_balance_amount" => 0,
                "base_gift_cards_amount" => 0,
                "gift_cards_amount" => 0,
                "gw_base_price" => "string",
                "gw_price" => "string",
                "gw_items_base_price" => "string",
                "gw_items_price" => "string",
                "gw_card_base_price" => "string",
                "gw_card_price" => "string",
                "gw_base_tax_amount" => "string",
                "gw_tax_amount" => "string",
                "gw_items_base_tax_amount" => "string",
                "gw_items_tax_amount" => "string",
                "gw_card_base_tax_amount" => "string",
                "gw_card_tax_amount" => "string"
            ]
        ];
    }
}