<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class PaymentData implements ValueObject
{
    public static function of($accountStatus, string $ccLast4, string $method)
    {
        return new self($accountStatus, $ccLast4, $method);
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['account_status'], $json['cc_last4'], $json['method']);
        $result->additionalData = $json['additional_data'] ?? null;
        $result->additionalInformation = $json['additional_information'] ?? [];
        $result->addressStatus = $json['address_status'] ?? null;
        $result->amountAuthorized = (string)($json['amount_authorized'] ?? null);
        $result->amountCanceled = (string)($json['amount_canceled'] ?? null);
        $result->amountOrdered = (string)($json['amount_ordered'] ?? null);
        $result->amountPaid = (string)($json['amount_paid'] ?? null);
        $result->amountRefunded = (string)($json['amount_refunded'] ?? null);
        $result->anetTransMethod = $json['anet_trans_method'] ?? null;
        $result->baseAmountAuthorized = (string)($json['base_amount_authorized'] ?? null);
        $result->baseAmountCanceled = (string)($json['base_amount_canceled'] ?? null);
        $result->baseAmountOrdered = (string)($json['base_amount_ordered'] ?? null);
        $result->baseAmountPaid = (string)($json['base_amount_paid'] ?? null);
        $result->baseAmountPaidOnline = (string)($json['base_amount_paid_online'] ?? null);
        $result->baseAmountRefunded = (string)($json['base_amount_refunded'] ?? null);
        $result->baseAmountRefundedOnline = (string)($json['base_amount_refunded_online'] ?? null);
        $result->baseShippingAmount = (string)($json['base_shipping_amount'] ?? null);
        $result->baseShippingCaptured = (string)($json['base_shipping_captured'] ?? null);
        $result->baseShippingRefunded = (string)($json['base_shipping_refunded'] ?? null);
        $result->ccApproval = $json['cc_approval'] ?? null;
        $result->ccAvsStatus = $json['cc_avs_status'] ?? null;
        $result->ccCidStatus = $json['cc_cid_status'] ?? null;
        $result->ccDebugRequestBody = $json['cc_debug_request_body'] ?? null;
        $result->ccDebugResponseBody = $json['cc_debug_response_body'] ?? null;
        $result->ccDebugResponseSerialized = $json['cc_debug_response_serialized'] ?? null;
        $result->ccExpMonth = $json['cc_exp_month'] ?? null;
        $result->ccExpYear = $json['cc_exp_year'] ?? null;
        $result->ccNumberEnc = $json['cc_number_enc'] ?? null;
        $result->ccOwner = $json['cc_owner'] ?? null;
        $result->ccSecureVerify = $json['cc_secure_verify'] ?? null;
        $result->ccSsIssue = $json['cc_ss_issue'] ?? null;
        $result->ccSsStartMonth = $json['cc_ss_start_month'] ?? null;
        $result->ccSsStartYear = $json['cc_ss_start_year'] ?? null;
        $result->ccStatus = $json['cc_status'] ?? null;
        $result->ccStatusDescription = $json['cc_status_description'] ?? null;
        $result->ccTransId = $json['cc_trans_id'] ?? null;
        $result->ccType = $json['cc_type'] ?? null;
        $result->echeckAccountName = $json['echeck_account_name'] ?? null;
        $result->echeckAccountType = $json['echeck_account_type'] ?? null;
        $result->echeckBankName = $json['echeck_bank_name'] ?? null;
        $result->echeckRoutingNumber = $json['echeck_routing_number'] ?? null;
        $result->echeckType = $json['echeck_type'] ?? null;
        $result->entityId = $json['entity_id'] ?? null;
        $result->lastTransId = $json['last_trans_id'] ?? null;
        $result->parentId = $json['parent_id'] ?? null;
        $result->poNumber = $json['po_number'] ?? null;
        $result->protectionEligibility = $json['protection_eligibility'] ?? null;
        $result->quotePaymentId = $json['quote_payment_id'] ?? null;
        $result->shippingAmount = (string)($json['shipping_amount'] ?? null);
        $result->shippingCaptured = (string)($json['shipping_captured'] ?? null);
        $result->shippingRefunded = (string)($json['shipping_refunded'] ?? null);
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    public function getAccountStatus() : ?string
    {
        return $this->accountStatus;
    }

    public function getAdditionalData() : ?string
    {
        return $this->additionalData;
    }

    public function getAdditionalInformation() : array
    {
        return $this->additionalInformation ?? [];
    }

    public function getAddressStatus() : string
    {
        return $this->addressStatus;
    }

    public function getAmountAuthorized() : ?string
    {
        return $this->amountAuthorized;
    }

    public function getAmountCanceled(): ?string
    {
        return $this->amountCanceled;
    }

    public function getAmountOrdered(): ?string
    {
        return $this->amountOrdered;
    }

    public function getAmountPaid(): ?string
    {
        return $this->amountPaid;
    }

    public function getAmountRefunded(): ?string
    {
        return $this->amountRefunded;
    }

    public function getAnetTransMethod(): ?string
    {
        return $this->anetTransMethod;
    }

    public function getBaseAmountAuthorized(): ?string
    {
        return $this->baseAmountAuthorized;
    }

    public function getBaseAmountCanceled(): ?string
    {
        return $this->baseAmountCanceled;
    }

    public function getBaseAmountOrdered(): ?string
    {
        return $this->baseAmountOrdered;
    }

    public function getBaseAmountPaid(): ?string
    {
        return $this->baseAmountPaid;
    }

    public function getBaseAmountPaidOnline(): ?string
    {
        return $this->baseAmountPaidOnline;
    }

    public function getBaseAmountRefunded(): ?string
    {
        return $this->baseAmountRefunded;
    }

    public function getBaseAmountRefundedOnline(): ?string
    {
        return $this->baseAmountRefundedOnline;
    }

    public function getBaseShippingAmount(): ?string
    {
        return $this->baseShippingAmount;
    }

    public function getBaseShippingCaptured(): ?string
    {
        return $this->baseShippingCaptured;
    }

    public function getBaseShippingRefunded(): ?string
    {
        return $this->baseShippingRefunded;
    }

    public function getCcApproval(): ?string
    {
        return $this->ccApproval;
    }

    public function getCcAvsStatus(): ?string
    {
        return $this->ccAvsStatus;
    }

    public function getCcCidStatus(): ?string
    {
        return $this->ccCidStatus;
    }

    public function getCcDebugRequestBody(): ?string
    {
        return $this->ccDebugRequestBody;
    }

    public function getCcDebugResponseBody(): ?string
    {
        return $this->ccDebugResponseBody;
    }

    public function getCcDebugResponseSerialized(): ?string
    {
        return $this->ccDebugResponseSerialized;
    }

    public function getCcExpMonth(): ?string
    {
        return $this->ccExpMonth;
    }

    public function getCcExpYear(): ?string
    {
        return $this->ccExpYear;
    }

    public function getCcLast4(): ?string
    {
        return $this->ccLast4;
    }

    public function getCcNumberEnc(): ?string
    {
        return $this->ccNumberEnc;
    }

    public function getCcOwner(): ?string
    {
        return $this->ccOwner;
    }

    public function getCcSecureVerify(): ?string
    {
        return $this->ccSecureVerify;
    }

    public function getCcSsIssue(): ?string
    {
        return $this->ccSsIssue;
    }

    public function getCcSsStartMonth(): ?string
    {
        return $this->ccSsStartMonth;
    }

    public function getCcSsStartYear(): ?string
    {
        return $this->ccSsStartYear;
    }

    public function getCcStatus(): ?string
    {
        return $this->ccStatus;
    }

    public function getCcStatusDescription(): ?string
    {
        return $this->ccStatusDescription;
    }

    public function getCcTransId(): ?string
    {
        return $this->ccTransId;
    }

    public function getCcType(): ?string
    {
        return $this->ccType;
    }

    public function getEcheckAccountName(): ?string
    {
        return $this->echeckAccountName;
    }

    public function getEcheckAccountType(): ?string
    {
        return $this->echeckAccountType;
    }

    public function getEcheckBankName(): ?string
    {
        return $this->echeckBankName;
    }

    public function getEcheckRoutingNumber(): ?string
    {
        return $this->echeckRoutingNumber;
    }

    public function getEcheckType(): ?string
    {
        return $this->echeckType;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function getLastTransId() : ?string
    {
        return $this->lastTransId;
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getParentId() : ?int
    {
        return $this->parentId;
    }

    public function getPoNumber() : ?string
    {
        return $this->poNumber;
    }

    public function getProtectionEligibility() : ?string
    {
        return $this->protectionEligibility;
    }

    public function getQuotePaymentId() : ?int
    {
        return $this->quotePaymentId;
    }

    public function getShippingAmount() : ?string
    {
        return $this->shippingAmount;
    }

    public function getShippingCaptured() : ?string
    {
        return $this->shippingCaptured;
    }

    public function getShippingRefunded() : ?string
    {
        return $this->shippingRefunded;
    }

    public function getExtensionAttributes() : ?ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withAccountStatus(string $accountStatus): self
    {
        $result = clone $this;
        $result->accountStatus = $accountStatus;
        return $result;
    }

    public function withAdditionalData(string $additionalData): self
    {
        $result = clone $this;
        $result->additionalData = $additionalData;
        return $result;
    }

    public function withAdditionalInformation(array $additionalInformation): self
    {
        $result = clone $this;
        $result->additionalInformation = $additionalInformation;
        return $result;
    }

    public function withAddressStatus(string $addressStatus): self
    {
        $result = clone $this;
        $result->addressStatus = $addressStatus;
        return $result;
    }

    public function withAmountAuthorized(string $amountAuthorized): self
    {
        $result = clone $this;
        $result->amountAuthorized = $amountAuthorized;
        return $result;
    }

    public function withAmountCanceled(string $amountCancled): self
    {
        $result = clone $this;
        $result->amountCanceled = $amountCancled;
        return $result;
    }

    public function withAmountOrdered(string $amountOrdered): self
    {
        $result = clone $this;
        $result->amountOrdered = $amountOrdered;
        return $result;
    }

    public function withAmountPaid(string $amountPaid): self
    {
        $result = clone $this;
        $result->amountPaid = $amountPaid;
        return $result;
    }

    public function withAmountRefunded(string $amountRefunded): self
    {
        $result = clone $this;
        $result->amountRefunded = $amountRefunded;
        return $result;
    }

    public function withAnetTransMethod(string $anetTransMethod): self
    {
        $result = clone $this;
        $result->anetTransMethod = $anetTransMethod;
        return $result;
    }

    public function withBaseAmountAuthorized(string $baseAmountAuthorized): self
    {
        $result = clone $this;
        $result->baseAmountAuthorized = $baseAmountAuthorized;
        return $result;
    }

    public function withBaseAmountCanceled(string $baseAmountCanceled): self
    {
        $result = clone $this;
        $result->baseAmountCanceled = $baseAmountCanceled;
        return $result;
    }

    public function withBaseAmountOrdered(string $baseAmountOrdered): self
    {
        $result = clone $this;
        $result->baseAmountOrdered = $baseAmountOrdered;
        return $result;
    }

    public function withBaseAmountPaid(string $baseAmountPaid): self
    {
        $result = clone $this;
        $result->baseAmountPaid = $baseAmountPaid;
        return $result;
    }

    public function withBaseAmountPaidOnline(string $baseAmountPaidOnline): self
    {
        $result = clone $this;
        $result->baseAmountPaidOnline = $baseAmountPaidOnline;
        return $result;
    }

    public function withBaseAmountRefunded(string $baseAmountRefunded): self
    {
        $result = clone $this;
        $result->baseAmountRefunded = $baseAmountRefunded;
        return $result;
    }

    public function withBaseAmountRefundedOnline(string $baseAmountRefundedOnline): self
    {
        $result = clone $this;
        $result->baseAmountRefundedOnline = $baseAmountRefundedOnline;
        return $result;
    }

    public function withBaseShippingAmount(string $baseShippingAmount): self
    {
        $result = clone $this;
        $result->baseShippingAmount = $baseShippingAmount;
        return $result;
    }

    public function withBaseShippingCaptured(string $baseShippingCaptured): self
    {
        $result = clone $this;
        $result->baseShippingCaptured = $baseShippingCaptured;
        return $result;
    }

    public function withBaseShippingRefunded(string $baseShippingRefunded): self
    {
        $result = clone $this;
        $result->baseShippingRefunded = $baseShippingRefunded;
        return $result;
    }

    public function withCcApproval(string $ccApproval): self
    {
        $result = clone $this;
        $result->ccApproval = $ccApproval;
        return $result;
    }

    public function withCcAvsStatus(string $ccAvsStatus): self
    {
        $result = clone $this;
        $result->ccAvsStatus = $ccAvsStatus;
        return $result;
    }

    public function withCcCidStatus(string $ccCidStatus): self
    {
        $result = clone $this;
        $result->ccCidStatus = $ccCidStatus;
        return $result;
    }

    public function withCcDebugRequestBody(string $ccDebugRequestBody): self
    {
        $result = clone $this;
        $result->ccDebugRequestBody = $ccDebugRequestBody;
        return $result;
    }

    public function withCcDebugResponseBody(string $ccDebugResponseBody): self
    {
        $result = clone $this;
        $result->ccDebugResponseBody = $ccDebugResponseBody;
        return $result;
    }

    public function withCcDebugResponseSerialized(string $ccDebugResponseSerialized): self
    {
        $result = clone $this;
        $result->ccDebugResponseSerialized = $ccDebugResponseSerialized;
        return $result;
    }

    public function withCcExpMonth(string $ccExpMonth): self
    {
        $result = clone $this;
        $result->ccExpMonth = $ccExpMonth;
        return $result;
    }

    public function withCcExpYear(string $ccExpYear): self
    {
        $result = clone $this;
        $result->ccExpYear = $ccExpYear;
        return $result;
    }

    public function withCcLast4(string $ccLast4): self
    {
        $result = clone $this;
        $result->ccLast4 = $ccLast4;
        return $result;
    }

    public function withCcNumberEnc(string $ccNumberEnc): self
    {
        $result = clone $this;
        $result->ccNumberEnc = $ccNumberEnc;
        return $result;
    }

    public function withCcOwner(string $ccOwner): self
    {
        $result = clone $this;
        $result->ccOwner = $ccOwner;
        return $result;
    }

    public function withCcSecureVerify(string $ccSecureVerify): self
    {
        $result = clone $this;
        $result->ccSecureVerify = $ccSecureVerify;
        return $result;
    }

    public function withCcSsIssue(string $ccSsIssue): self
    {
        $result = clone $this;
        $result->ccSsIssue = $ccSsIssue;
        return $result;
    }

    public function withCcSsStartMonth(string $ccSsStartMonth): self
    {
        $result = clone $this;
        $result->ccSsStartMonth = $ccSsStartMonth;
        return $result;
    }

    public function withCcSsStartYear(string $ccSsStartYear): self
    {
        $result = clone $this;
        $result->ccSsStartYear = $ccSsStartYear;
        return $result;
    }

    public function withCcStatus(string $ccStatus): self
    {
        $result = clone $this;
        $result->ccStatus = $ccStatus;
        return $result;
    }

    public function withCcStatusDescription(string $ccStatusDescription): self
    {
        $result = clone $this;
        $result->ccStatusDescription = $ccStatusDescription;
        return $result;
    }

    public function withCcTransId(string $ccTransId): self
    {
        $result = clone $this;
        $result->ccTransId = $ccTransId;
        return $result;
    }

    public function withCcType(string $ccType): self
    {
        $result = clone $this;
        $result->ccType = $ccType;
        return $result;
    }

    public function withEcheckAccountName(string $echeckAccountName): self
    {
        $result = clone $this;
        $result->echeckAccountName = $echeckAccountName;
        return $result;
    }

    public function withEcheckAccountType(string $echeckAccountType): self
    {
        $result = clone $this;
        $result->echeckAccountType = $echeckAccountType;
        return $result;
    }

    public function withEcheckBankName(string $echeckBankName): self
    {
        $result = clone $this;
        $result->echeckBankName = $echeckBankName;
        return $result;
    }

    public function withEcheckRoutingNumber(string $echeckRoutingNumber): self
    {
        $result = clone $this;
        $result->echeckRoutingNumber = $echeckRoutingNumber;
        return $result;
    }

    public function withEcheckType(string $echeckType): self
    {
        $result = clone $this;
        $result->echeckType = $echeckType;
        return $result;
    }

    public function withEntityId(int $entityId): self
    {
        $result = clone $this;
        $result->entityId = $entityId;
        return $result;
    }

    public function withLastTransId(string $lastTransId): self
    {
        $result = clone $this;
        $result->lastTransId = $lastTransId;
        return $result;
    }

    public function withMethod(string $method): self
    {
        $result = clone $this;
        $result->method = $method;
        return $result;
    }

    public function withParentId(int $parentId): self
    {
        $result = clone $this;
        $result->parentId = $parentId;
        return $result;
    }

    public function withPoNumber(string $poNumber): self
    {
        $result = clone $this;
        $result->poNumber = $poNumber;
        return $result;
    }

    public function withProtectionEligibility(string $protectionEligibility): self
    {
        $result = clone $this;
        $result->protectionEligibility = $protectionEligibility;
        return $result;
    }

    public function withQuotePaymentId(int $quotePaymentId): self
    {
        $result = clone $this;
        $result->quotePaymentId = $quotePaymentId;
        return $result;
    }

    public function withShippingAmount(string $shippingAmount): self
    {
        $result = clone $this;
        $result->shippingAmount = $shippingAmount;
        return $result;
    }

    public function withShippingCaptured(string $shippingCaptured): self
    {
        $result = clone $this;
        $result->shippingCaptured = $shippingCaptured;
        return $result;
    }

    public function withShippingRefunded(string $shippingRefunded): self
    {
        $result = clone $this;
        $result->shippingRefunded = $shippingRefunded;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttribute): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttribute;
        return $result;
    }

    public function toJson()
    {
        return [
            "account_status" => $this->accountStatus,
            "additional_data" => $this->additionalData,
            "additional_information" => $this->additionalInformation,
            "address_status" => $this->addressStatus,
            "amount_authorized" => $this->amountAuthorized,
            "amount_canceled" => $this->amountCanceled,
            "amount_ordered" => $this->amountOrdered,
            "amount_paid" => $this->amountPaid,
            "amount_refunded" => $this->amountRefunded,
            "anet_trans_method" => $this->anetTransMethod,
            "base_amount_authorized" => $this->baseAmountAuthorized,
            "base_amount_canceled" => $this->baseAmountCanceled,
            "base_amount_ordered" => $this->baseAmountOrdered,
            "base_amount_paid" => $this->baseAmountPaid,
            "base_amount_paid_online" => $this->baseAmountPaidOnline,
            "base_amount_refunded" => $this->baseAmountRefunded,
            "base_amount_refunded_online" => $this->baseAmountRefundedOnline,
            "base_shipping_amount" => $this->baseShippingAmount,
            "base_shipping_captured" => $this->baseShippingCaptured,
            "base_shipping_refunded" => $this->baseShippingRefunded,
            "cc_approval" => $this->ccApproval,
            "cc_avs_status" => $this->ccAvsStatus,
            "cc_cid_status" => $this->ccCidStatus,
            "cc_debug_request_body" => $this->ccDebugRequestBody,
            "cc_debug_response_body" => $this->ccDebugResponseBody,
            "cc_debug_response_serialized" => $this->ccDebugResponseSerialized,
            "cc_exp_month" => $this->ccExpMonth,
            "cc_exp_year" => $this->ccExpYear,
            "cc_last4" => $this->ccLast4,
            "cc_number_enc" => $this->ccNumberEnc,
            "cc_owner" => $this->ccOwner,
            "cc_secure_verify" => $this->ccSecureVerify,
            "cc_ss_issue" => $this->ccSsIssue,
            "cc_ss_start_month" => $this->ccSsStartMonth,
            "cc_ss_start_year" => $this->ccSsStartYear,
            "cc_status" => $this->ccStatus,
            "cc_status_description" => $this->ccStatusDescription,
            "cc_trans_id" => $this->ccTransId,
            "cc_type" => $this->ccType,
            "echeck_account_name" => $this->echeckAccountName,
            "echeck_account_type" => $this->echeckAccountType,
            "echeck_bank_name" => $this->echeckBankName,
            "echeck_routing_number" => $this->echeckRoutingNumber,
            "echeck_type" => $this->echeckType,
            "entity_id" => $this->entityId,
            "last_trans_id" => $this->lastTransId,
            "method" => $this->method,
            "parent_id" => $this->parentId,
            "po_number" => $this->poNumber,
            "protection_eligibility" => $this->protectionEligibility,
            "quote_payment_id" => $this->quotePaymentId,
            "shipping_amount" => $this->shippingAmount,
            "shipping_captured" => $this->shippingCaptured,
            "shipping_refunded" => $this->shippingRefunded,
            "extension_attributes" => $this->extensionAttributes->toJson()
        ];
    }

    private $accountStatus;
    private $additionalData;
    private $additionalInformation;
    private $addressStatus;
    private $amountAuthorized;
    private $amountCanceled;
    private $amountOrdered;
    private $amountPaid;
    private $amountRefunded;
    private $anetTransMethod;
    private $baseAmountAuthorized;
    private $baseAmountCanceled;
    private $baseAmountOrdered;
    private $baseAmountPaid;
    private $baseAmountPaidOnline;
    private $baseAmountRefunded;
    private $baseAmountRefundedOnline;
    private $baseShippingAmount;
    private $baseShippingCaptured;
    private $baseShippingRefunded;
    private $ccApproval;
    private $ccAvsStatus;
    private $ccCidStatus;
    private $ccDebugRequestBody;
    private $ccDebugResponseBody;
    private $ccDebugResponseSerialized;
    private $ccExpMonth;
    private $ccExpYear;
    private $ccLast4;
    private $ccNumberEnc;
    private $ccOwner;
    private $ccSecureVerify;
    private $ccSsIssue;
    private $ccSsStartMonth;
    private $ccSsStartYear;
    private $ccStatus;
    private $ccStatusDescription;
    private $ccTransId;
    private $ccType;
    private $echeckAccountName;
    private $echeckAccountType;
    private $echeckBankName;
    private $echeckRoutingNumber;
    private $echeckType;
    private $entityId;
    private $lastTransId;
    private $method;
    private $parentId;
    private $poNumber;
    private $protectionEligibility;
    private $quotePaymentId;
    private $shippingAmount;
    private $shippingCaptured;
    private $shippingRefunded;
    private $extensionAttributes;

    private function __construct($accountStatus, string $ccLast4, string $method)
    {
        $this->accountStatus = $accountStatus;
        $this->ccLast4 = $ccLast4;
        $this->method = $method;
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }

    public function equals($other): bool
    {
        return $other instanceof self &&
        $this->accountStatus === $other->accountStatus &&
        $this->additionalData === $other->additionalData &&
        $this->additionalInformation === $other->additionalInformation &&
        $this->addressStatus === $other->addressStatus &&
        $this->amountAuthorized === $other->amountAuthorized &&
        $this->amountCanceled === $other->amountCanceled &&
        $this->amountOrdered === $other->amountOrdered &&
        $this->amountPaid === $other->amountPaid &&
        $this->amountRefunded === $other->amountRefunded &&
        $this->anetTransMethod === $other->anetTransMethod &&
        $this->baseAmountAuthorized === $other->baseAmountAuthorized &&
        $this->baseAmountCanceled === $other->baseAmountCanceled &&
        $this->baseAmountOrdered === $other->baseAmountOrdered &&
        $this->baseAmountPaid === $other->baseAmountPaid &&
        $this->baseAmountPaidOnline === $other->baseAmountPaidOnline &&
        $this->baseAmountRefunded === $other->baseAmountRefunded &&
        $this->baseAmountRefundedOnline === $other->baseAmountRefundedOnline &&
        $this->baseShippingAmount === $other->baseShippingAmount &&
        $this->baseShippingCaptured === $other->baseShippingCaptured &&
        $this->baseShippingRefunded === $other->baseShippingRefunded &&
        $this->ccApproval === $other->ccApproval &&
        $this->ccAvsStatus === $other->ccAvsStatus &&
        $this->ccCidStatus === $other->ccCidStatus &&
        $this->ccDebugRequestBody === $other->ccDebugRequestBody &&
        $this->ccDebugResponseBody === $other->ccDebugResponseBody &&
        $this->ccDebugResponseSerialized === $other->ccDebugResponseSerialized &&
        $this->ccExpMonth === $other->ccExpMonth &&
        $this->ccExpYear === $other->ccExpYear &&
        $this->ccLast4 === $other->ccLast4 &&
        $this->ccNumberEnc === $other->ccNumberEnc &&
        $this->ccOwner === $other->ccOwner &&
        $this->ccSecureVerify === $other->ccSecureVerify &&
        $this->ccSsIssue === $other->ccSsIssue &&
        $this->ccSsStartMonth === $other->ccSsStartMonth &&
        $this->ccSsStartYear === $other->ccSsStartYear &&
        $this->ccStatus === $other->ccStatus &&
        $this->ccStatusDescription === $other->ccStatusDescription &&
        $this->ccTransId === $other->ccTransId &&
        $this->ccType === $other->ccType &&
        $this->echeckAccountName === $other->echeckAccountName &&
        $this->echeckAccountType === $other->echeckAccountType &&
        $this->echeckBankName === $other->echeckBankName &&
        $this->echeckRoutingNumber === $other->echeckRoutingNumber &&
        $this->echeckType === $other->echeckType &&
        $this->entityId === $other->entityId &&
        $this->lastTransId === $other->lastTransId &&
        $this->method === $other->method &&
        $this->parentId === $other->parentId &&
        $this->poNumber === $other->poNumber &&
        $this->protectionEligibility === $other->protectionEligibility &&
        $this->quotePaymentId === $other->quotePaymentId &&
        $this->shippingAmount === $other->shippingAmount &&
        $this->shippingCaptured === $other->shippingCaptured &&
        $this->shippingRefunded === $other->shippingRefunded &&
        $this->extensionAttributes->equals($other->extensionAttributes);
    }
}
