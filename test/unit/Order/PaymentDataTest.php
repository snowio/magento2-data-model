<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\ItemData;
use SnowIO\Magento2DataModel\Order\PaymentData;

class PaymentDataTest extends TestCase
{
    public function testToJson()
    {
        $payment = $this->getPayment();
        self::assertEquals(self::getPaymentJson(), $payment->toJson());
    }

    public function testFromJson()
    {
        $payment = PaymentData::fromJson(self::getPaymentJson());
        self::assertNull($payment->getAccountStatus());
        self::assertEquals("string", $payment->getAdditionalData());
        self::assertEquals(["string"], $payment->getAdditionalInformation());
        self::assertEquals("string", $payment->getAddressStatus());
        self::assertEquals("0", $payment->getAmountAuthorized());
        self::assertEquals("0", $payment->getAmountCanceled());
        self::assertEquals("0", $payment->getAmountOrdered());
        self::assertEquals("0", $payment->getAmountPaid());
        self::assertEquals("0", $payment->getAmountRefunded());
        self::assertEquals("string", $payment->getAnetTransMethod());
        self::assertEquals("0", $payment->getBaseAmountAuthorized());
        self::assertEquals("0", $payment->getBaseAmountCanceled());
        self::assertEquals("0", $payment->getBaseAmountOrdered());
        self::assertEquals("0", $payment->getBaseAmountPaid());
        self::assertEquals("0", $payment->getBaseAmountPaidOnline());
        self::assertEquals("0", $payment->getBaseAmountRefunded());
        self::assertEquals("0", $payment->getBaseAmountRefundedOnline());
        self::assertEquals("0", $payment->getBaseShippingAmount());
        self::assertEquals("0", $payment->getBaseShippingCaptured());
        self::assertEquals("0", $payment->getBaseShippingRefunded());
        self::assertEquals("string", $payment->getCcApproval());
        self::assertEquals("string", $payment->getCcAvsStatus());
        self::assertEquals("string", $payment->getCcCidStatus());
        self::assertEquals("string", $payment->getCcDebugRequestBody());
        self::assertEquals("string", $payment->getCcDebugResponseBody());
        self::assertEquals("string", $payment->getCcDebugResponseSerialized());
        self::assertEquals("string", $payment->getCcExpMonth());
        self::assertEquals("string", $payment->getCcExpYear());
        self::assertEquals("string", $payment->getCcLast4());
        self::assertEquals("string", $payment->getCcNumberEnc());
        self::assertEquals("string", $payment->getCcOwner());
        self::assertEquals("string", $payment->getCcSecureVerify());
        self::assertEquals("string", $payment->getCcSsIssue());
        self::assertEquals("string", $payment->getCcSsStartMonth());
        self::assertEquals("string", $payment->getCcSsStartYear());
        self::assertEquals("string", $payment->getCcStatus());
        self::assertEquals("string", $payment->getCcStatusDescription());
        self::assertEquals("string", $payment->getCcTransId());
        self::assertEquals("string", $payment->getCcType());
        self::assertEquals("string", $payment->getEcheckAccountName());
        self::assertEquals("string", $payment->getEcheckAccountType());
        self::assertEquals("string", $payment->getEcheckBankName());
        self::assertEquals("string", $payment->getEcheckRoutingNumber());
        self::assertEquals("string", $payment->getEcheckType());
        self::assertEquals(0, $payment->getEntityId());
        self::assertEquals("string", $payment->getLastTransId());
        self::assertEquals("string", $payment->getMethod());
        self::assertEquals(0, $payment->getParentId());
        self::assertEquals("string", $payment->getPoNumber());
        self::assertEquals("string", $payment->getProtectionEligibility());
        self::assertEquals(0, $payment->getQuotePaymentId());
        self::assertEquals("0", $payment->getShippingAmount());
        self::assertEquals("0", $payment->getShippingCaptured());
        self::assertEquals("0", $payment->getShippingRefunded());
        self::assertTrue(ExtensionAttributeSet::of([
            ExtensionAttribute::of('vault_payment_token', [
                "entity_id" => 0,
                "customer_id" => 0,
                "public_hash" => "string",
                "payment_method_code" => "string",
                "type" => "string",
                "created_at" => "string",
                "expires_at" => "string",
                "gateway_token" => "string",
                "token_details" => "string",
                "is_active" => true,
                "is_visible" => true
            ]),
        ])->equals($payment->getExtensionAttributes()));
        self::assertTrue(self::getPayment()->equals($payment));
    }

    public function testEquals()
    {
        $payment = self::getPayment();
        $otherPayment = self::getPayment();
        self::assertTrue($payment->equals($otherPayment));
        self::assertFalse(($payment->withAddressStatus('moved'))->equals($payment));
        self::assertFalse($payment->equals(ItemData::of('124')));
    }

    public static function getPaymentJson(): array
    {
        return [
            "account_status" => null,
            "additional_data" => "string",
            "additional_information" => [
                "string"
            ],
            "address_status" => "string",
            "amount_authorized" => "0",
            "amount_canceled" => "0",
            "amount_ordered" => "0",
            "amount_paid" => "0",
            "amount_refunded" => "0",
            "anet_trans_method" => "string",
            "base_amount_authorized" => "0",
            "base_amount_canceled" => "0",
            "base_amount_ordered" => "0",
            "base_amount_paid" => "0",
            "base_amount_paid_online" => "0",
            "base_amount_refunded" => "0",
            "base_amount_refunded_online" => "0",
            "base_shipping_amount" => "0",
            "base_shipping_captured" => "0",
            "base_shipping_refunded" => "0",
            "cc_approval" => "string",
            "cc_avs_status" => "string",
            "cc_cid_status" => "string",
            "cc_debug_request_body" => "string",
            "cc_debug_response_body" => "string",
            "cc_debug_response_serialized" => "string",
            "cc_exp_month" => "string",
            "cc_exp_year" => "string",
            "cc_last4" => "string",
            "cc_number_enc" => "string",
            "cc_owner" => "string",
            "cc_secure_verify" => "string",
            "cc_ss_issue" => "string",
            "cc_ss_start_month" => "string",
            "cc_ss_start_year" => "string",
            "cc_status" => "string",
            "cc_status_description" => "string",
            "cc_trans_id" => "string",
            "cc_type" => "string",
            "echeck_account_name" => "string",
            "echeck_account_type" => "string",
            "echeck_bank_name" => "string",
            "echeck_routing_number" => "string",
            "echeck_type" => "string",
            "entity_id" => 0,
            "last_trans_id" => "string",
            "method" => "string",
            "parent_id" => 0,
            "po_number" => "string",
            "protection_eligibility" => "string",
            "quote_payment_id" => 0,
            "shipping_amount" => "0",
            "shipping_captured" => "0",
            "shipping_refunded" => "0",
            "extension_attributes" => [
                "vault_payment_token" => [
                    "entity_id" => 0,
                    "customer_id" => 0,
                    "public_hash" => "string",
                    "payment_method_code" => "string",
                    "type" => "string",
                    "created_at" => "string",
                    "expires_at" => "string",
                    "gateway_token" => "string",
                    "token_details" => "string",
                    "is_active" => true,
                    "is_visible" => true
                ]
            ]
        ];

    }

    public static function getPayment(): PaymentData
    {
        return PaymentData::create()
            ->withAdditionalData("string")
            ->withAdditionalInformation(["string"])
            ->withAddressStatus("string")
            ->withAmountAuthorized("0")
            ->withAmountCanceled("0")
            ->withAmountOrdered("0")
            ->withAmountPaid("0")
            ->withAmountRefunded("0")
            ->withAnetTransMethod("string")
            ->withBaseAmountAuthorized("0")
            ->withBaseAmountCanceled("0")
            ->withBaseAmountOrdered("0")
            ->withBaseAmountPaid("0")
            ->withBaseAmountPaidOnline("0")
            ->withBaseAmountRefunded("0")
            ->withBaseAmountRefundedOnline("0")
            ->withBaseShippingAmount("0")
            ->withBaseShippingCaptured("0")
            ->withBaseShippingRefunded("0")
            ->withCcApproval("string")
            ->withCcAvsStatus("string")
            ->withCcCidStatus("string")
            ->withCcDebugRequestBody("string")
            ->withCcDebugResponseBody("string")
            ->withCcDebugResponseSerialized("string")
            ->withCcExpMonth("string")
            ->withCcExpYear("string")
            ->withCcLast4("string")
            ->withCcNumberEnc("string")
            ->withCcOwner("string")
            ->withCcSecureVerify("string")
            ->withCcSsIssue("string")
            ->withCcSsStartMonth("string")
            ->withCcSsStartYear("string")
            ->withCcStatus("string")
            ->withCcStatusDescription("string")
            ->withCcTransId("string")
            ->withCcType("string")
            ->withEcheckAccountName("string")
            ->withEcheckAccountType("string")
            ->withEcheckBankName("string")
            ->withEcheckRoutingNumber("string")
            ->withEcheckType("string")
            ->withEntityId(0)
            ->withLastTransId("string")
            ->withMethod("string")
            ->withParentId(0)
            ->withPoNumber("string")
            ->withProtectionEligibility("string")
            ->withQuotePaymentId(0)
            ->withShippingAmount("0")
            ->withShippingCaptured("0")
            ->withShippingRefunded("0")
            ->withExtensionAttributes(
                ExtensionAttributeSet::of([
                    ExtensionAttribute::of("vault_payment_token", [
                        "entity_id" => 0,
                        "customer_id" => 0,
                        "public_hash" => "string",
                        "payment_method_code" => "string",
                        "type" => "string",
                        "created_at" => "string",
                        "expires_at" => "string",
                        "gateway_token" => "string",
                        "token_details" => "string",
                        "is_active" => true,
                        "is_visible" => true
                    ])
                ])
            );
    }
}
