<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Order\AddressData;
use SnowIO\Magento2DataModel\Order\ItemDataCollection;
use SnowIO\Magento2DataModel\Order\PaymentData;
use SnowIO\Magento2DataModel\Order\StatusHistoryDataCollection;

final class OrderData implements ValueObject
{
    public static function create(): self
    {
        return new self();
    }


    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->baseGrandTotal = $json['base_grand_total'];
        $result->customerEmail = $json['customer_email'];
        $result->grandTotal = $json['grand_total'];
        $result->adjustmentNegative = (string)($json['adjustment_negative'] ?? null);
        $result->adjustmentPositive = (string)($json['adjustment_positive'] ?? null);
        $result->appliedRuleIds = $json['applied_rule_ids'] ?? null;
        $result->baseAdjustmentNegative = (string)($json['base_adjustment_negative'] ?? null);
        $result->baseAdjustmentPositive = (string)($json['base_adjustment_positive'] ?? null);
        $result->baseCurrencyCode = $json['base_currency_code'] ?? null;
        $result->baseDiscountAmount = (string)($json['base_discount_amount'] ?? null);
        $result->baseDiscountCanceled = (string)($json['base_discount_canceled'] ?? null);
        $result->baseDiscountInvoiced = (string)($json['base_discount_invoiced'] ?? null);
        $result->baseDiscountRefunded = (string)($json['base_discount_refunded'] ?? null);
        $result->baseDiscountTaxCompensationAmount = (string)($json['base_discount_tax_compensation_amount'] ?? null);
        $result->baseDiscountTaxCompensationInvoiced = (string)($json['base_discount_tax_compensation_invoiced'] ?? null);
        $result->baseDiscountTaxCompensationRefunded = (string)($json['base_discount_tax_compensation_refunded'] ?? null);
        $result->baseShippingAmount = (string)($json['base_shipping_amount'] ?? null);
        $result->baseShippingCanceled = (string)($json['base_shipping_canceled'] ?? null);
        $result->baseShippingDiscountAmount = (string)($json['base_shipping_discount_amount'] ?? null);
        $result->baseShippingDiscountTaxCompensationAmnt =
            (string)($json['base_shipping_discount_tax_compensation_amnt'] ?? null);
        $result->baseShippingInclTax = (string)($json['base_shipping_incl_tax'] ?? null);
        $result->baseShippingInvoiced = (string)($json['base_shipping_invoiced'] ?? null);
        $result->baseShippingRefunded = (string)($json['base_shipping_refunded'] ?? null);
        $result->baseShippingTaxAmount = (string)($json['base_shipping_tax_amount'] ?? null);
        $result->baseShippingTaxRefunded = (string)($json['base_shipping_tax_refunded'] ?? null);
        $result->baseSubtotal = (string)($json['base_subtotal'] ?? null);
        $result->baseSubtotalCanceled = (string)($json['base_subtotal_canceled'] ?? null);
        $result->baseSubtotalInclTax = (string)($json['base_subtotal_incl_tax'] ?? null);
        $result->baseSubtotalInvoiced = (string)($json['base_subtotal_invoiced'] ?? null);
        $result->baseSubtotalRefunded = (string)($json['base_subtotal_refunded'] ?? null);
        $result->baseTaxAmount = (string)($json['base_tax_amount'] ?? null);
        $result->baseTaxCanceled = (string)($json['base_tax_canceled'] ?? null);
        $result->baseTaxInvoiced = (string)($json['base_tax_invoiced'] ?? null);
        $result->baseTaxRefunded = (string)($json['base_tax_refunded'] ?? null);
        $result->baseTotalCanceled = (string)($json['base_total_canceled'] ?? null);
        $result->baseTotalDue = (string)($json['base_total_due'] ?? null);
        $result->baseTotalInvoiced = (string)($json['base_total_invoiced'] ?? null);
        $result->baseTotalInvoicedCost = (string)($json['base_total_invoiced_cost'] ?? null);
        $result->baseTotalOfflineRefunded = (string)($json['base_total_offline_refunded'] ?? null);
        $result->baseTotalOnlineRefunded = (string)($json['base_total_online_refunded'] ?? null);
        $result->baseTotalPaid = (string)($json['base_total_paid'] ?? null);
        $result->baseTotalQtyOrdered = (string)($json['base_total_qty_ordered'] ?? null);
        $result->baseTotalRefunded = (string)($json['base_total_refunded'] ?? null);
        $result->baseToGlobalRate = (string)($json['base_to_global_rate'] ?? null);
        $result->baseToOrderRate = (string)($json['base_to_order_rate'] ?? null);
        $result->billingAddressId = (string)($json['billing_address_id'] ?? null);
        $result->canShipPartially = $json['can_ship_partially'] ?? null;
        $result->canShipPartiallyItem = $json['can_ship_partially_item'] ?? null;
        $result->couponCode = $json['coupon_code'] ?? null;
        $result->createdAt = $json['created_at'] ?? null;
        $result->customerDob = $json['customer_dob'] ?? null;
        $result->customerFirstname = $json['customer_firstname'] ?? null;
        $result->customerGender = $json['customer_gender'] ?? null;
        $result->customerGroupId = (string)($json['customer_group_id'] ?? null);
        $result->customerId = (string) ($json['customer_id'] ?? null);
        $result->customerIsGuest = $json['customer_is_guest'] ?? null;
        $result->customerLastname = $json['customer_lastname'] ?? null;
        $result->customerMiddlename = $json['customer_middlename'] ?? null;
        $result->customerNote = $json['customer_note'] ?? null;
        $result->customerNoteNotify = $json['customer_note_notify'] ?? null;
        $result->customerPrefix = $json['customer_prefix'] ?? null;
        $result->customerSuffix = $json['customer_suffix'] ?? null;
        $result->customerTaxvat = $json['customer_taxvat'] ?? null;
        $result->discountAmount = (string)($json['discount_amount'] ?? null);
        $result->discountCanceled = (string)($json['discount_canceled'] ?? null);
        $result->discountDescription = $json['discount_description'] ?? null;
        $result->discountInvoiced = (string)($json['discount_invoiced'] ?? null);
        $result->discountRefunded = (string)($json['discount_refunded'] ?? null);
        $result->editIncrement = $json['edit_increment'] ?? null;
        $result->emailSent = $json['email_sent'] ?? null;
        $result->entityId = (string) $json['entity_id'] ?? null;
        $result->extCustomerId = (string)($json['ext_customer_id'] ?? null);
        $result->extOrderId = (string) ($json['ext_order_id'] ?? null);
        $result->forcedShipmentWithInvoice = $json['forced_shipment_with_invoice'] ?? null;
        $result->globalCurrencyCode = $json['global_currency_code'] ?? null;
        $result->discountTaxCompensationAmount = (string)($json['discount_tax_compensation_amount'] ?? null);
        $result->discountTaxCompensationInvoiced = (string)($json['discount_tax_compensation_invoiced'] ?? null);
        $result->discountTaxCompensationRefunded = (string)($json['discount_tax_compensation_refunded'] ?? null);
        $result->holdBeforeState = $json['hold_before_state'] ?? null;
        $result->holdBeforeStatus = $json['hold_before_status'] ?? null;
        $result->incrementId = (string)($json['increment_id'] ?? null);
        $result->isVirtual = $json['is_virtual'] ?? null;
        $result->orderCurrencyCode = $json['order_currency_code'] ?? null;
        $result->originalIncrementId = (string)($json['original_increment_id'] ?? null);
        $result->paymentAuthorizationAmount = (string)($json['payment_authorization_amount'] ?? null);
        $result->paymentAuthExpiration = $json['payment_auth_expiration'] ?? null;
        $result->protectCode = $json['protect_code'] ?? null;
        $result->quoteAddressId = (string)($json['quote_address_id'] ?? null);
        $result->quoteId = (string)($json['quote_id'] ?? null);
        $result->relationChildId = (string)($json['relation_child_id'] ?? null);
        $result->relationChildRealId = (string)($json['relation_child_real_id'] ?? null);
        $result->relationParentId = (string)($json['relation_parent_id'] ?? null);
        $result->relationParentRealId = (string)($json['relation_parent_real_id'] ?? null);
        $result->remoteIp = (string) ($json['remote_ip'] ?? null);
        $result->shippingAmount = (string)($json['shipping_amount'] ?? null);
        $result->shippingCanceled = (string)($json['shipping_canceled'] ?? null);
        $result->shippingDescription = $json['shipping_description'] ?? null;
        $result->shippingDiscountAmount = (string)($json['shipping_discount_amount'] ?? null);
        $result->shippingDiscountTaxCompensationAmount =
            (string)($json['shipping_discount_tax_compensation_amount'] ?? null);
        $result->shippingInclTax = (string)($json['shipping_incl_tax'] ?? null);
        $result->shippingInvoiced = (string)($json['shipping_invoiced'] ?? null);
        $result->shippingRefunded = (string)($json['shipping_refunded'] ?? null);
        $result->shippingTaxAmount = (string)($json['shipping_tax_amount'] ?? null);
        $result->shippingTaxRefunded = (string)($json['shipping_tax_refunded'] ?? null);
        $result->state = $json['state'] ?? null;
        $result->status = $json['status'] ?? null;
        $result->storeCurrencyCode = $json['store_currency_code'] ?? null;
        $result->storeId = (string) ($json['store_id'] ?? null);
        $result->storeName = $json['store_name'] ?? null;
        $result->storeToBaseRate = (string)($json['store_to_base_rate'] ?? null);
        $result->storeToOrderRate = (string)($json['store_to_order_rate'] ?? null);
        $result->subtotal = (string)($json['subtotal'] ?? null);
        $result->subtotalCanceled = (string)($json['subtotal_canceled'] ?? null);
        $result->subtotalInclTax = (string)($json['subtotal_incl_tax'] ?? null);
        $result->subtotalInvoiced = (string)($json['subtotal_invoiced'] ?? null);
        $result->subtotalRefunded = (string)($json['subtotal_refunded'] ?? null);
        $result->taxAmount = (string)($json['tax_amount'] ?? null);
        $result->taxCanceled = (string)($json['tax_canceled'] ?? null);
        $result->taxInvoiced = (string)($json['tax_invoiced'] ?? null);
        $result->taxRefunded = (string)($json['tax_refunded'] ?? null);
        $result->totalCanceled = (string)($json['total_canceled'] ?? null);
        $result->totalDue = (string)($json['total_due'] ?? null);
        $result->totalInvoiced = (string)($json['total_invoiced'] ?? null);
        $result->totalItemCount = $json['total_item_count'] ?? null;
        $result->totalOfflineRefunded = (string)($json['total_offline_refunded'] ?? null);
        $result->totalOnlineRefunded = (string)($json['total_online_refunded'] ?? null);
        $result->totalPaid = (string)($json['total_paid'] ?? null);
        $result->totalQtyOrdered = (string)($json['total_qty_ordered'] ?? null);
        $result->totalRefunded = (string)($json['total_refunded'] ?? null);
        $result->updatedAt = $json['updated_at'] ?? null;
        $result->weight = (string)($json['weight'] ?? null);
        $result->xForwardedFor = $json['x_forwarded_for'] ?? null;
        $result->items = ItemDataCollection::fromJson($json['items']);
        $result->billingAddress =
            !isset($json['billing_address']) ? null : AddressData::fromJson($json['billing_address']);
        $result->payment = !isset($json['payment']) ? null : PaymentData::fromJson($json['payment']);
        $result->statusHistories =
            !isset($json['status_histories']) ?
                null : StatusHistoryDataCollection::fromJson($json['status_histories'] ?? []);
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    public function withAdjustmentNegative(string $adjustmentNegative) : self
    {
        $result = clone $this;
        $result->adjustmentNegative = $adjustmentNegative;
        return $result;
    }

    public function withGrandTotal(string $grandTotal) : self
    {
        $result = clone $this;
        $result->grandTotal = $grandTotal;
        return $result;
    }

    public function withBaseGrandTotal(string $baseGrandTotal) : self
    {
        $result = clone $this;
        $result->baseGrandTotal = $baseGrandTotal;
        return $result;
    }

    public function withAdjustmentPositive(string $adjustmentPositive) : self
    {
        $result = clone $this;
        $result->adjustmentPositive = $adjustmentPositive;
        return $result;
    }

    public function withAppliedRuleIds(string $appliedRuleIds) : self
    {
        $result = clone $this;
        $result->appliedRuleIds = $appliedRuleIds;
        return $result;
    }

    public function withBaseAdjustmentNegative(string $baseAdjustmentNegative) : self
    {
        $result = clone $this;
        $result->baseAdjustmentNegative = $baseAdjustmentNegative;
        return $result;
    }

    public function withBaseAdjustmentPositive(string $baseAdjustmentPositive) : self
    {
        $result = clone $this;
        $result->baseAdjustmentPositive = $baseAdjustmentPositive;
        return $result;
    }

    public function withBaseCurrencyCode(string $baseCurrencyCode) : self
    {
        $result = clone $this;
        $result->baseCurrencyCode = $baseCurrencyCode;
        return $result;
    }

    public function withBaseDiscountAmount(string $baseDiscountAmount) : self
    {
        $result = clone $this;
        $result->baseDiscountAmount = $baseDiscountAmount;
        return $result;
    }

    public function withBaseDiscountCanceled(string $baseDiscountCanceled) : self
    {
        $result = clone $this;
        $result->baseDiscountCanceled = $baseDiscountCanceled;
        return $result;
    }

    public function withBaseDiscountInvoiced(string $baseDiscountInvoiced) : self
    {
        $result = clone $this;
        $result->baseDiscountInvoiced = $baseDiscountInvoiced;
        return $result;
    }

    public function withBaseDiscountRefunded(string $baseDiscountRefunded) : self
    {
        $result = clone $this;
        $result->baseDiscountRefunded = $baseDiscountRefunded;
        return $result;
    }

    public function withBaseDiscountTaxCompensationAmount(string $baseDiscountTaxCompensationAmount) : self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationAmount = $baseDiscountTaxCompensationAmount;
        return $result;
    }

    public function withBaseDiscountTaxCompensationInvoiced(string $baseDiscountTaxCompensationInvoiced) : self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationInvoiced = $baseDiscountTaxCompensationInvoiced;
        return $result;
    }

    public function withBaseDiscountTaxCompensationRefunded(string $baseDiscountTaxCompensationRefunded) : self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationRefunded = $baseDiscountTaxCompensationRefunded;
        return $result;
    }

    public function withBaseShippingAmount(string $baseShippingAmount) : self
    {
        $result = clone $this;
        $result->baseShippingAmount = $baseShippingAmount;
        return $result;
    }

    public function withBaseShippingCanceled(string $baseShippingCanceled) : self
    {
        $result = clone $this;
        $result->baseShippingCanceled = $baseShippingCanceled;
        return $result;
    }

    public function withBaseShippingDiscountAmount(string $baseShippingDiscountAmount) : self
    {
        $result = clone $this;
        $result->baseShippingDiscountAmount = $baseShippingDiscountAmount;
        return $result;
    }

    public function withBaseShippingDiscountTaxCompensationAmnt(string $baseShippingDiscountTaxCompensationAmnt) : self
    {
        $result = clone $this;
        $result->baseShippingDiscountTaxCompensationAmnt = $baseShippingDiscountTaxCompensationAmnt;
        return $result;
    }

    public function withBaseShippingInclTax(string $baseShippingInclTax) : self
    {
        $result = clone $this;
        $result->baseShippingInclTax = $baseShippingInclTax;
        return $result;
    }

    public function withBaseShippingInvoiced(string $baseShippingInvoiced) : self
    {
        $result = clone $this;
        $result->baseShippingInvoiced = $baseShippingInvoiced;
        return $result;
    }

    public function withBaseShippingRefunded(string $baseShippingRefunded) : self
    {
        $result = clone $this;
        $result->baseShippingRefunded = $baseShippingRefunded;
        return $result;
    }

    public function withBaseShippingTaxAmount(string $baseShippingTaxAmount) : self
    {
        $result = clone $this;
        $result->baseShippingTaxAmount = $baseShippingTaxAmount;
        return $result;
    }

    public function withBaseShippingTaxRefunded(string $baseShippingTaxRefunded) : self
    {
        $result = clone $this;
        $result->baseShippingTaxRefunded = $baseShippingTaxRefunded;
        return $result;
    }

    public function withBaseSubtotal(string $baseSubtotal) : self
    {
        $result = clone $this;
        $result->baseSubtotal = $baseSubtotal;
        return $result;
    }

    public function withBaseSubtotalCanceled(string $baseSubtotalCanceled) : self
    {
        $result = clone $this;
        $result->baseSubtotalCanceled = $baseSubtotalCanceled;
        return $result;
    }

    public function withBaseSubtotalInclTax(string $baseSubtotalInclTax) : self
    {
        $result = clone $this;
        $result->baseSubtotalInclTax = $baseSubtotalInclTax;
        return $result;
    }

    public function withBaseSubtotalInvoiced(string $baseSubtotalInvoiced) : self
    {
        $result = clone $this;
        $result->baseSubtotalInvoiced = $baseSubtotalInvoiced;
        return $result;
    }

    public function withBaseSubtotalRefunded(string $baseSubtotalRefunded) : self
    {
        $result = clone $this;
        $result->baseSubtotalRefunded = $baseSubtotalRefunded;
        return $result;
    }

    public function withBaseTaxAmount(string $baseTaxAmount) : self
    {
        $result = clone $this;
        $result->baseTaxAmount = $baseTaxAmount;
        return $result;
    }

    public function withBaseTaxCanceled(string $baseTaxCanceled) : self
    {
        $result = clone $this;
        $result->baseTaxCanceled = $baseTaxCanceled;
        return $result;
    }

    public function withBaseTaxInvoiced(string $baseTaxInvoiced) : self
    {
        $result = clone $this;
        $result->baseTaxInvoiced = $baseTaxInvoiced;
        return $result;
    }

    public function withBaseTaxRefunded(string $baseTaxRefunded) : self
    {
        $result = clone $this;
        $result->baseTaxRefunded = $baseTaxRefunded;
        return $result;
    }

    public function withBaseTotalCanceled(string $baseTotalCanceled) : self
    {
        $result = clone $this;
        $result->baseTotalCanceled = $baseTotalCanceled;
        return $result;
    }

    public function withBaseTotalDue(string $baseTotalDue) : self
    {
        $result = clone $this;
        $result->baseTotalDue = $baseTotalDue;
        return $result;
    }

    public function withBaseTotalInvoiced(string $baseTotalInvoiced) : self
    {
        $result = clone $this;
        $result->baseTotalInvoiced = $baseTotalInvoiced;
        return $result;
    }

    public function withBaseTotalInvoicedCost(string $baseTotalInvoicedCost) : self
    {
        $result = clone $this;
        $result->baseTotalInvoicedCost = $baseTotalInvoicedCost;
        return $result;
    }

    public function withBaseTotalOfflineRefunded(string $baseTotalOfflineRefunded) : self
    {
        $result = clone $this;
        $result->baseTotalOfflineRefunded = $baseTotalOfflineRefunded;
        return $result;
    }

    public function withBaseTotalOnlineRefunded(string $baseTotalOnlineRefunded) : self
    {
        $result = clone $this;
        $result->baseTotalOnlineRefunded = $baseTotalOnlineRefunded;
        return $result;
    }

    public function withBaseTotalPaid(string $baseTotalPaid) : self
    {
        $result = clone $this;
        $result->baseTotalPaid = $baseTotalPaid;
        return $result;
    }

    public function withBaseTotalQtyOrdered(string $baseTotalQtyOrdered) : self
    {
        $result = clone $this;
        $result->baseTotalQtyOrdered = $baseTotalQtyOrdered;
        return $result;
    }

    public function withBaseTotalRefunded(string $baseTotalRefunded) : self
    {
        $result = clone $this;
        $result->baseTotalRefunded = $baseTotalRefunded;
        return $result;
    }

    public function withBaseToGlobalRate(string $baseToGlobalRate) : self
    {
        $result = clone $this;
        $result->baseToGlobalRate = $baseToGlobalRate;
        return $result;
    }

    public function withBaseToOrderRate(string $baseToOrderRate) : self
    {
        $result = clone $this;
        $result->baseToOrderRate = $baseToOrderRate;
        return $result;
    }

    public function withBillingAddressId(string $billingAddressId) : self
    {
        $result = clone $this;
        $result->billingAddressId = $billingAddressId;
        return $result;
    }

    public function withCanShipPartially(int $canShipPartially) : self
    {
        $result = clone $this;
        $result->canShipPartially = $canShipPartially;
        return $result;
    }

    public function withCanShipPartiallyItem(int $canShipPartiallyItem) : self
    {
        $result = clone $this;
        $result->canShipPartiallyItem = $canShipPartiallyItem;
        return $result;
    }

    public function withCouponCode(string $couponCode) : self
    {
        $result = clone $this;
        $result->couponCode = $couponCode;
        return $result;
    }

    public function withCreatedAt(string $createdAt) : self
    {
        $result = clone $this;
        $result->createdAt = $createdAt;
        return $result;
    }

    public function withCustomerDob(string $customerDob) : self
    {
        $result = clone $this;
        $result->customerDob = $customerDob;
        return $result;
    }

    public function withCustomerEmail(string $customerEmail) : self
    {
        $result = clone $this;
        $result->customerEmail = $customerEmail;
        return $result;
    }

    public function withCustomerFirstname(string $customerFirstname) : self
    {
        $result = clone $this;
        $result->customerFirstname = $customerFirstname;
        return $result;
    }

    public function withCustomerGender(int $customerGender) : self
    {
        $result = clone $this;
        $result->customerGender = $customerGender;
        return $result;
    }

    public function withCustomerGroupId(string $customerGroupId) : self
    {
        $result = clone $this;
        $result->customerGroupId = $customerGroupId;
        return $result;
    }

    public function withCustomerId(string $customerId) : self
    {
        $result = clone $this;
        $result->customerId = $customerId;
        return $result;
    }

    public function withCustomerIsGuest(int $customerIsGuest) : self
    {
        $result = clone $this;
        $result->customerIsGuest = $customerIsGuest;
        return $result;
    }

    public function withCustomerLastname(string $customerLastname) : self
    {
        $result = clone $this;
        $result->customerLastname = $customerLastname;
        return $result;
    }

    public function withCustomerMiddlename(string $customerMiddlename) : self
    {
        $result = clone $this;
        $result->customerMiddlename = $customerMiddlename;
        return $result;
    }

    public function withCustomerNote(string $customerNote) : self
    {
        $result = clone $this;
        $result->customerNote = $customerNote;
        return $result;
    }

    public function withCustomerNoteNotify(int $customerNoteNotify) : self
    {
        $result = clone $this;
        $result->customerNoteNotify = $customerNoteNotify;
        return $result;
    }

    public function withCustomerPrefix(string $customerPrefix) : self
    {
        $result = clone $this;
        $result->customerPrefix = $customerPrefix;
        return $result;
    }

    public function withCustomerSuffix(string $customerSuffix) : self
    {
        $result = clone $this;
        $result->customerSuffix = $customerSuffix;
        return $result;
    }

    public function withCustomerTaxvat(string $customerTaxvat) : self
    {
        $result = clone $this;
        $result->customerTaxvat = $customerTaxvat;
        return $result;
    }

    public function withDiscountAmount(string $discountAmount) : self
    {
        $result = clone $this;
        $result->discountAmount = $discountAmount;
        return $result;
    }

    public function withDiscountCanceled(string $discountCanceled) : self
    {
        $result = clone $this;
        $result->discountCanceled = $discountCanceled;
        return $result;
    }

    public function withDiscountDescription(string $discountDescription) : self
    {
        $result = clone $this;
        $result->discountDescription = $discountDescription;
        return $result;
    }

    public function withDiscountInvoiced(string $discountInvoiced) : self
    {
        $result = clone $this;
        $result->discountInvoiced = $discountInvoiced;
        return $result;
    }

    public function withDiscountRefunded(string $discountRefunded) : self
    {
        $result = clone $this;
        $result->discountRefunded = $discountRefunded;
        return $result;
    }

    public function withEditIncrement(int $editIncrement) : self
    {
        $result = clone $this;
        $result->editIncrement = $editIncrement;
        return $result;
    }

    public function withEmailSent(int $emailSent) : self
    {
        $result = clone $this;
        $result->emailSent = $emailSent;
        return $result;
    }

    public function withEntityId(string $entityId) : self
    {
        $result = clone $this;
        $result->entityId = $entityId;
        return $result;
    }

    public function withExtCustomerId(string $extCustomerId) : self
    {
        $result = clone $this;
        $result->extCustomerId = $extCustomerId;
        return $result;
    }

    public function withExtOrderId(string $extOrderId) : self
    {
        $result = clone $this;
        $result->extOrderId = $extOrderId;
        return $result;
    }

    public function withForcedShipmentWithInvoice(int $forcedShipmentWithInvoice) : self
    {
        $result = clone $this;
        $result->forcedShipmentWithInvoice = $forcedShipmentWithInvoice;
        return $result;
    }

    public function withGlobalCurrencyCode(string $globalCurrencyCode) : self
    {
        $result = clone $this;
        $result->globalCurrencyCode = $globalCurrencyCode;
        return $result;
    }

    public function withDiscountTaxCompensationAmount(string $discountTaxCompensationAmount) : self
    {
        $result = clone $this;
        $result->discountTaxCompensationAmount = $discountTaxCompensationAmount;
        return $result;
    }

    public function withDiscountTaxCompensationInvoiced(string $discountTaxCompensationInvoiced) : self
    {
        $result = clone $this;
        $result->discountTaxCompensationInvoiced = $discountTaxCompensationInvoiced;
        return $result;
    }

    public function withDiscountTaxCompensationRefunded(string $discountTaxCompensationRefunded) : self
    {
        $result = clone $this;
        $result->discountTaxCompensationRefunded = $discountTaxCompensationRefunded;
        return $result;
    }

    public function withHoldBeforeState(string $holdBeforeState) : self
    {
        $result = clone $this;
        $result->holdBeforeState = $holdBeforeState;
        return $result;
    }

    public function withHoldBeforeStatus(string $holdBeforeStatus) : self
    {
        $result = clone $this;
        $result->holdBeforeStatus = $holdBeforeStatus;
        return $result;
    }

    public function withIncrementId(string $incrementId) : self
    {
        $result = clone $this;
        $result->incrementId = $incrementId;
        return $result;
    }

    public function withIsVirtual(int $isVirtual) : self
    {
        $result = clone $this;
        $result->isVirtual = $isVirtual;
        return $result;
    }

    public function withOrderCurrencyCode(string $orderCurrencyCode) : self
    {
        $result = clone $this;
        $result->orderCurrencyCode = $orderCurrencyCode;
        return $result;
    }

    public function withOriginalIncrementId(string $originalIncrementId) : self
    {
        $result = clone $this;
        $result->originalIncrementId = $originalIncrementId;
        return $result;
    }

    public function withPaymentAuthorizationAmount(string $paymentAuthorizationAmount) : self
    {
        $result = clone $this;
        $result->paymentAuthorizationAmount = $paymentAuthorizationAmount;
        return $result;
    }

    public function withPaymentAuthExpiration(int $paymentAuthExpiration) : self
    {
        $result = clone $this;
        $result->paymentAuthExpiration = $paymentAuthExpiration;
        return $result;
    }

    public function withProtectCode(string $protectCode) : self
    {
        $result = clone $this;
        $result->protectCode = $protectCode;
        return $result;
    }

    public function withQuoteAddressId(string $quoteAddressId) : self
    {
        $result = clone $this;
        $result->quoteAddressId = $quoteAddressId;
        return $result;
    }

    public function withQuoteId(string $quoteId) : self
    {
        $result = clone $this;
        $result->quoteId = $quoteId;
        return $result;
    }

    public function withRelationChildId(string $relationChildId) : self
    {
        $result = clone $this;
        $result->relationChildId = $relationChildId;
        return $result;
    }

    public function withRelationChildRealId(string $relationChildRealId) : self
    {
        $result = clone $this;
        $result->relationChildRealId = $relationChildRealId;
        return $result;
    }

    public function withRelationParentId(string $relationParentId) : self
    {
        $result = clone $this;
        $result->relationParentId = $relationParentId;
        return $result;
    }

    public function withRelationParentRealId(string $relationParentRealId) : self
    {
        $result = clone $this;
        $result->relationParentRealId = $relationParentRealId;
        return $result;
    }

    public function withRemoteIp(string $remoteIp) : self
    {
        $result = clone $this;
        $result->remoteIp = $remoteIp;
        return $result;
    }

    public function withShippingAmount(string $shippingAmount) : self
    {
        $result = clone $this;
        $result->shippingAmount = $shippingAmount;
        return $result;
    }

    public function withShippingCanceled(string $shippingCanceled) : self
    {
        $result = clone $this;
        $result->shippingCanceled = $shippingCanceled;
        return $result;
    }

    public function withShippingDescription(string $shippingDescription) : self
    {
        $result = clone $this;
        $result->shippingDescription = $shippingDescription;
        return $result;
    }

    public function withShippingDiscountAmount(string $shippingDiscountAmount) : self
    {
        $result = clone $this;
        $result->shippingDiscountAmount = $shippingDiscountAmount;
        return $result;
    }

    public function withShippingDiscountTaxCompensationAmount(string $shippingDiscountTaxCompensationAmount) : self
    {
        $result = clone $this;
        $result->shippingDiscountTaxCompensationAmount = $shippingDiscountTaxCompensationAmount;
        return $result;
    }

    public function withShippingInclTax(string $shippingInclTax) : self
    {
        $result = clone $this;
        $result->shippingInclTax = $shippingInclTax;
        return $result;
    }

    public function withShippingInvoiced(string $shippingInvoiced) : self
    {
        $result = clone $this;
        $result->shippingInvoiced = $shippingInvoiced;
        return $result;
    }

    public function withShippingRefunded(string $shippingRefunded) : self
    {
        $result = clone $this;
        $result->shippingRefunded = $shippingRefunded;
        return $result;
    }

    public function withShippingTaxAmount(string $shippingTaxAmount) : self
    {
        $result = clone $this;
        $result->shippingTaxAmount = $shippingTaxAmount;
        return $result;
    }

    public function withShippingTaxRefunded(string $shippingTaxRefunded) : self
    {
        $result = clone $this;
        $result->shippingTaxRefunded = $shippingTaxRefunded;
        return $result;
    }

    public function withState(string $state) : self
    {
        $result = clone $this;
        $result->state = $state;
        return $result;
    }

    public function withStatus(string $status) : self
    {
        $result = clone $this;
        $result->status = $status;
        return $result;
    }

    public function withStoreCurrencyCode(string $storeCurrencyCode) : self
    {
        $result = clone $this;
        $result->storeCurrencyCode = $storeCurrencyCode;
        return $result;
    }

    public function withStoreId(string $storeId) : self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function withStoreName(string $storeName) : self
    {
        $result = clone $this;
        $result->storeName = $storeName;
        return $result;
    }

    public function withStoreToBaseRate(string $storeToBaseRate) : self
    {
        $result = clone $this;
        $result->storeToBaseRate = $storeToBaseRate;
        return $result;
    }

    public function withStoreToOrderRate(string $storeToOrderRate) : self
    {
        $result = clone $this;
        $result->storeToOrderRate = $storeToOrderRate;
        return $result;
    }

    public function withSubtotal(string $subtotal) : self
    {
        $result = clone $this;
        $result->subtotal = $subtotal;
        return $result;
    }

    public function withSubtotalCanceled(string $subtotalCanceled) : self
    {
        $result = clone $this;
        $result->subtotalCanceled = $subtotalCanceled;
        return $result;
    }

    public function withSubtotalInclTax(string $subtotalIncTax) : self
    {
        $result = clone $this;
        $result->subtotalInclTax = $subtotalIncTax;
        return $result;
    }

    public function withSubtotalInvoiced(string $subtotalInvoiced) : self
    {
        $result = clone $this;
        $result->subtotalInvoiced = $subtotalInvoiced;
        return $result;
    }

    public function withSubtotalRefunded(string $subtotalRefunded) : self
    {
        $result = clone $this;
        $result->subtotalRefunded = $subtotalRefunded;
        return $result;
    }

    public function withTaxAmount(string $taxAmount) : self
    {
        $result = clone $this;
        $result->taxAmount = $taxAmount;
        return $result;
    }

    public function withTaxCanceled(string $taxCanceled) : self
    {
        $result = clone $this;
        $result->taxCanceled = $taxCanceled;
        return $result;
    }

    public function withTaxInvoiced(string $taxInvoiced) : self
    {
        $result = clone $this;
        $result->taxInvoiced = $taxInvoiced;
        return $result;
    }

    public function withTaxRefunded(string $taxRefunded) : self
    {
        $result = clone $this;
        $result->taxRefunded = $taxRefunded;
        return $result;
    }

    public function withTotalCanceled(string $totalCanceled) : self
    {
        $result = clone $this;
        $result->totalCanceled = $totalCanceled;
        return $result;
    }

    public function withTotalDue(string $totalDue) : self
    {
        $result = clone $this;
        $result->totalDue = $totalDue;
        return $result;
    }

    public function withTotalInvoiced(string $totalInvoiced) : self
    {
        $result = clone $this;
        $result->totalInvoiced = $totalInvoiced;
        return $result;
    }

    public function withTotalItemCount(int $totalItemCount) : self
    {
        $result = clone $this;
        $result->totalItemCount = $totalItemCount;
        return $result;
    }

    public function withTotalOfflineRefunded(string $totalOfflineRefunded) : self
    {
        $result = clone $this;
        $result->totalOfflineRefunded = $totalOfflineRefunded;
        return $result;
    }

    public function withTotalOnlineRefunded(string $totalOnlineRefunded) : self
    {
        $result = clone $this;
        $result->totalOnlineRefunded = $totalOnlineRefunded;
        return $result;
    }

    public function withTotalPaid(string $totalPaid) : self
    {
        $result = clone $this;
        $result->totalPaid = $totalPaid;
        return $result;
    }

    public function withTotalQtyOrdered(string $totalQtyOrdered) : self
    {
        $result = clone $this;
        $result->totalQtyOrdered = $totalQtyOrdered;
        return $result;
    }

    public function withTotalRefunded(string $totalRefunded) : self
    {
        $result = clone $this;
        $result->totalRefunded = $totalRefunded;
        return $result;
    }

    public function withUpdatedAt(string $updatedAt) : self
    {
        $result = clone $this;
        $result->updatedAt = $updatedAt;
        return $result;
    }

    public function withWeight(string $weight) : self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    public function withXForwardedFor(string $xForwardedFor) : self
    {
        $result = clone $this;
        $result->xForwardedFor = $xForwardedFor;
        return $result;
    }

    public function withItems(ItemDataCollection $itemDataSet) : self
    {
        $result = clone $this;
        $result->items = $itemDataSet;
        return $result;
    }

    public function withBillingAddress(AddressData $billingAddress) : self
    {
        $result = clone $this;
        $result->billingAddress = $billingAddress;
        return $result;
    }

    public function withPayment(PaymentData $payment) : self
    {
        $result = clone $this;
        $result->payment = $payment;
        return $result;
    }

    public function withStatusHistories(StatusHistoryDataCollection $statusHistories) : self
    {
        $result = clone $this;
        $result->statusHistories = $statusHistories;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes) : self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function getAdjustmentNegative(): ?string
    {
        return $this->adjustmentNegative;
    }

    public function getAdjustmentPositive(): ?string
    {
        return $this->adjustmentPositive;
    }

    public function getAppliedRuleIds(): ?string
    {
        return $this->appliedRuleIds;
    }

    public function getBaseAdjustmentNegative(): ?string
    {
        return $this->baseAdjustmentNegative;
    }

    public function getBaseAdjustmentPositive(): ?string
    {
        return $this->baseAdjustmentPositive;
    }

    public function getBaseCurrencyCode(): ?string
    {
        return $this->baseCurrencyCode;
    }

    public function getBaseDiscountAmount(): ?string
    {
        return $this->baseDiscountAmount;
    }

    public function getBaseDiscountCanceled(): ?string
    {
        return $this->baseDiscountCanceled;
    }

    public function getBaseDiscountInvoiced(): ?string
    {
        return $this->baseDiscountInvoiced;
    }

    public function getBaseDiscountRefunded(): ?string
    {
        return $this->baseDiscountRefunded;
    }

    public function getBaseGrandTotal(): string
    {
        return $this->baseGrandTotal;
    }

    public function getBaseDiscountTaxCompensationAmount(): ?string
    {
        return $this->baseDiscountTaxCompensationAmount;
    }

    public function getBaseDiscountTaxCompensationInvoiced(): ?string
    {
        return $this->baseDiscountTaxCompensationInvoiced;
    }

    public function getBaseDiscountTaxCompensationRefunded(): ?string
    {
        return $this->baseDiscountTaxCompensationRefunded;
    }

    public function getBaseShippingAmount(): ?string
    {
        return $this->baseShippingAmount;
    }

    public function getBaseShippingCanceled(): ?string
    {
        return $this->baseShippingCanceled;
    }

    public function getBaseShippingDiscountAmount(): ?string
    {
        return $this->baseShippingDiscountAmount;
    }

    public function getBaseShippingDiscountTaxCompensationAmnt(): ?string
    {
        return $this->baseShippingDiscountTaxCompensationAmnt;
    }

    public function getBaseShippingInclTax(): ?string
    {
        return $this->baseShippingInclTax;
    }

    public function getBaseShippingInvoiced(): ?string
    {
        return $this->baseShippingInvoiced;
    }

    public function getBaseShippingRefunded(): ?string
    {
        return $this->baseShippingRefunded;
    }

    public function getBaseShippingTaxAmount(): ?string
    {
        return $this->baseShippingTaxAmount;
    }

    public function getBaseShippingTaxRefunded(): ?string
    {
        return $this->baseShippingTaxRefunded;
    }

    public function getBaseSubtotal(): ?string
    {
        return $this->baseSubtotal;
    }

    public function getBaseSubtotalCanceled(): ?string
    {
        return $this->baseSubtotalCanceled;
    }

    public function getBaseSubtotalInclTax(): ?string
    {
        return $this->baseSubtotalInclTax;
    }

    public function getBaseSubtotalInvoiced(): ?string
    {
        return $this->baseSubtotalInvoiced;
    }

    public function getBaseSubtotalRefunded(): ?string
    {
        return $this->baseSubtotalRefunded;
    }

    public function getBaseTaxAmount(): ?string
    {
        return $this->baseTaxAmount;
    }

    public function getBaseTaxCanceled(): ?string
    {
        return $this->baseTaxCanceled;
    }

    public function getBaseTaxInvoiced(): ?string
    {
        return $this->baseTaxInvoiced;
    }

    public function getBaseTaxRefunded(): ?string
    {
        return $this->baseTaxRefunded;
    }

    public function getBaseTotalCanceled(): ?string
    {
        return $this->baseTotalCanceled;
    }

    public function getBaseTotalDue(): ?string
    {
        return $this->baseTotalDue;
    }

    public function getBaseTotalInvoiced(): ?string
    {
        return $this->baseTotalInvoiced;
    }

    public function getBaseTotalInvoicedCost(): ?string
    {
        return $this->baseTotalInvoicedCost;
    }

    public function getBaseTotalOfflineRefunded(): ?string
    {
        return $this->baseTotalOfflineRefunded;
    }

    public function getBaseTotalOnlineRefunded(): ?string
    {
        return $this->baseTotalOnlineRefunded;
    }

    public function getBaseTotalPaid(): ?string
    {
        return $this->baseTotalPaid;
    }

    public function getBaseTotalQtyOrdered(): ?string
    {
        return $this->baseTotalQtyOrdered;
    }

    public function getBaseTotalRefunded(): ?string
    {
        return $this->baseTotalRefunded;
    }

    public function getBaseToGlobalRate(): ?string
    {
        return $this->baseToGlobalRate;
    }

    public function getBaseToOrderRate(): ?string
    {
        return $this->baseToOrderRate;
    }

    public function getBillingAddressId(): ?string
    {
        return $this->billingAddressId;
    }

    public function canShipPartially(): ?int
    {
        return $this->canShipPartially;
    }

    public function canShipPartiallyItem(): ?int
    {
        return $this->canShipPartially;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getCustomerDob(): ?string
    {
        return $this->customerDob;
    }

    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    public function getCustomerFirstname(): ?string
    {
        return $this->customerFirstname;
    }

    public function getCustomerGender(): ?int
    {
        return $this->customerGender;
    }

    public function getCustomerGroupId(): ?string
    {
        return $this->customerGroupId;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function customerIsGuest(): ?int
    {
        return $this->customerIsGuest;
    }

    public function getCustomerLastname(): ?string
    {
        return $this->customerLastname;
    }

    public function getCustomerMiddlename(): ?string
    {
        return $this->customerMiddlename;
    }

    public function getCustomerNote(): ?string
    {
        return $this->customerNote;
    }

    public function getCustomerNoteNotify(): ?int
    {
        return $this->customerNoteNotify;
    }

    public function getCustomerPrefix(): ?string
    {
        return $this->customerPrefix;
    }

    public function getCustomerSuffix(): ?string
    {
        return $this->customerSuffix;
    }

    public function getCustomerTaxvat(): ?string
    {
        return $this->customerTaxvat;
    }

    public function getDiscountAmount(): ?string
    {
        return $this->discountAmount;
    }

    public function getDiscountCanceled(): ?string
    {
        return $this->discountCanceled;
    }

    public function getDiscountDescription(): ?string
    {
        return $this->discountDescription;
    }

    public function getDiscountInvoiced(): ?string
    {
        return $this->discountInvoiced;
    }

    public function getDiscountRefunded(): ?string
    {
        return $this->discountRefunded;
    }

    public function getEditIncrement(): ?int
    {
        return $this->editIncrement;
    }

    public function getEmailSent(): ?int
    {
        return $this->emailSent;
    }

    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    public function getExtCustomerId(): ?string
    {
        return $this->extCustomerId;
    }

    public function getExtOrderId(): ?string
    {
        return $this->extOrderId;
    }

    public function getForcedShipmentWithInvoice(): ?int
    {
        return $this->forcedShipmentWithInvoice;
    }

    public function getGlobalCurrencyCode(): ?string
    {
        return $this->globalCurrencyCode;
    }

    public function getGrandTotal(): ?string
    {
        return $this->grandTotal;
    }

    public function getDiscountTaxCompensationAmount(): ?string
    {
        return $this->discountTaxCompensationAmount;
    }

    public function getDiscountTaxCompensationInvoiced(): ?string
    {
        return $this->discountTaxCompensationInvoiced;
    }

    public function getDiscountTaxCompensationRefunded(): ?string
    {
        return $this->discountTaxCompensationRefunded;
    }

    public function getHoldBeforeState(): ?string
    {
        return $this->holdBeforeState;
    }

    public function getHoldBeforeStatus(): ?string
    {
        return $this->holdBeforeStatus;
    }

    public function getIncrementId(): ?string
    {
        return $this->incrementId;
    }

    public function getIsVirtual(): ?int
    {
        return $this->isVirtual;
    }

    public function getOrderCurrencyCode(): ?string
    {
        return $this->orderCurrencyCode;
    }

    public function getOriginalIncrementId(): ?string
    {
        return $this->originalIncrementId;
    }

    public function getPaymentAuthorizationAmount(): ?string
    {
        return $this->paymentAuthorizationAmount;
    }

    public function getPaymentAuthExpiration(): ?int
    {
        return $this->paymentAuthExpiration;
    }

    public function getProtectCode(): ?string
    {
        return $this->protectCode;
    }

    public function getQuoteAddressId(): ?string
    {
        return $this->quoteAddressId;
    }

    public function getQuoteId(): ?string
    {
        return $this->quoteId;
    }

    public function getRelationChildId(): ?string
    {
        return $this->relationChildId;
    }

    public function getRelationChildRealId(): ?string
    {
        return $this->relationChildRealId;
    }

    public function getRelationParentId(): ?string
    {
        return $this->relationParentId;
    }

    public function getRelationParentRealId(): ?string
    {
        return $this->relationParentRealId;
    }

    public function getRemoteIp(): ?string
    {
        return $this->remoteIp;
    }

    public function getShippingAmount(): ?string
    {
        return $this->shippingAmount;
    }

    public function getShippingCanceled(): ?string
    {
        return $this->shippingCanceled;
    }

    public function getShippingDescription(): ?string
    {
        return $this->shippingDescription;
    }

    public function getShippingDiscountAmount(): ?string
    {
        return $this->shippingDiscountAmount;
    }

    public function getShippingDiscountTaxCompensationAmount(): ?string
    {
        return $this->shippingDiscountTaxCompensationAmount;
    }

    public function getShippingInclTax(): ?string
    {
        return $this->shippingInclTax;
    }

    public function getShippingInvoiced(): ?string
    {
        return $this->shippingInvoiced;
    }

    public function getShippingRefunded(): ?string
    {
        return $this->shippingRefunded;
    }

    public function getShippingTaxAmount(): ?string
    {
        return $this->shippingTaxAmount;
    }

    public function getShippingTaxRefunded(): ?string
    {
        return $this->shippingTaxRefunded;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getStoreCurrencyCode(): ?string
    {
        return $this->storeCurrencyCode;
    }

    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    public function getStoreToBaseRate(): ?string
    {
        return $this->storeToBaseRate;
    }

    public function getStoreToOrderRate(): ?string
    {
        return $this->storeToOrderRate;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function getSubtotalCanceled(): ?string
    {
        return $this->subtotalCanceled;
    }

    public function getSubtotalInclTax(): ?string
    {
        return $this->subtotalInclTax;
    }

    public function getSubtotalInvoiced(): ?string
    {
        return $this->subtotalInvoiced;
    }

    public function getSubtotalRefunded(): ?string
    {
        return $this->subtotalRefunded;
    }

    public function getTaxAmount(): ?string
    {
        return $this->taxAmount;
    }

    public function getTaxCanceled(): ?string
    {
        return $this->taxCanceled;
    }

    public function getTaxInvoiced(): ?string
    {
        return $this->taxInvoiced;
    }

    public function getTaxRefunded(): ?string
    {
        return $this->taxRefunded;
    }

    public function getTotalCanceled(): ?string
    {
        return $this->totalCanceled;
    }

    public function getTotalDue(): ?string
    {
        return $this->totalDue;
    }

    public function getTotalInvoiced(): ?string
    {
        return $this->totalInvoiced;
    }

    public function getTotalItemCount(): ?int
    {
        return $this->totalItemCount;
    }

    public function getTotalOfflineRefunded(): ?string
    {
        return $this->totalOfflineRefunded;
    }

    public function getTotalOnlineRefunded(): ?string
    {
        return $this->totalOnlineRefunded;
    }

    public function getTotalPaid(): ?string
    {
        return $this->totalPaid;
    }

    public function getTotalQtyOrdered(): ?string
    {
        return $this->totalQtyOrdered;
    }

    public function getTotalRefunded(): ?string
    {
        return $this->totalRefunded;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function getXForwardedFor(): ?string
    {
        return $this->xForwardedFor;
    }

    public function getItems(): ItemDataCollection
    {
        return $this->items;
    }

    public function getBillingAddress(): ?AddressData
    {
        return $this->billingAddress;
    }

    public function getPayment(): ?PaymentData
    {
        return $this->payment;
    }

    public function getStatusHistories(): ?StatusHistoryDataCollection
    {
        return $this->statusHistories;
    }

    public function getExtensionAttributes(): ?ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function toJson()
    {
        return [
            "adjustment_negative" => $this->adjustmentNegative,
            "adjustment_positive" => $this->adjustmentPositive,
            "applied_rule_ids" => $this->appliedRuleIds,
            "base_adjustment_negative" => $this->baseAdjustmentNegative,
            "base_adjustment_positive" => $this->baseAdjustmentPositive,
            "base_currency_code" => $this->baseCurrencyCode,
            "base_discount_amount" => $this->baseDiscountAmount,
            "base_discount_canceled" => $this->baseDiscountCanceled,
            "base_discount_invoiced" => $this->baseDiscountInvoiced,
            "base_discount_refunded" => $this->baseDiscountRefunded,
            "base_grand_total" => $this->baseGrandTotal,
            "base_discount_tax_compensation_amount" => $this->baseDiscountTaxCompensationAmount,
            "base_discount_tax_compensation_invoiced" => $this->baseDiscountTaxCompensationInvoiced,
            "base_discount_tax_compensation_refunded" => $this->baseDiscountTaxCompensationRefunded,
            "base_shipping_amount" => $this->baseShippingAmount,
            "base_shipping_canceled" => $this->baseShippingCanceled,
            "base_shipping_discount_amount" => $this->baseShippingDiscountAmount,
            "base_shipping_discount_tax_compensation_amnt" => $this->baseShippingDiscountTaxCompensationAmnt,
            "base_shipping_incl_tax" => $this->baseShippingInclTax,
            "base_shipping_invoiced" => $this->baseShippingInvoiced,
            "base_shipping_refunded" => $this->baseShippingRefunded,
            "base_shipping_tax_amount" => $this->baseShippingTaxAmount,
            "base_shipping_tax_refunded" => $this->baseShippingTaxRefunded,
            "base_subtotal" => $this->baseSubtotal,
            "base_subtotal_canceled" => $this->baseSubtotalCanceled,
            "base_subtotal_incl_tax" => $this->baseSubtotalInclTax,
            "base_subtotal_invoiced" => $this->baseSubtotalInvoiced,
            "base_subtotal_refunded" => $this->baseSubtotalRefunded,
            "base_tax_amount" => $this->baseTaxAmount,
            "base_tax_canceled" => $this->baseTaxCanceled,
            "base_tax_invoiced" => $this->baseTaxInvoiced,
            "base_tax_refunded" => $this->baseTaxRefunded,
            "base_total_canceled" => $this->baseTotalCanceled,
            "base_total_due" => $this->baseTotalDue,
            "base_total_invoiced" => $this->baseTotalInvoiced,
            "base_total_invoiced_cost" => $this->baseTotalInvoicedCost,
            "base_total_offline_refunded" => $this->baseTotalOfflineRefunded,
            "base_total_online_refunded" => $this->baseTotalOnlineRefunded,
            "base_total_paid" => $this->baseTotalPaid,
            "base_total_qty_ordered" => $this->baseTotalQtyOrdered,
            "base_total_refunded" => $this->baseTotalRefunded,
            "base_to_global_rate" => $this->baseToGlobalRate,
            "base_to_order_rate" => $this->baseToOrderRate,
            "billing_address_id" => (string) $this->billingAddressId,
            "can_ship_partially" => $this->canShipPartially,
            "can_ship_partially_item" => $this->canShipPartiallyItem,
            "coupon_code" => $this->couponCode,
            "created_at" => $this->createdAt,
            "customer_dob" => $this->customerDob,
            "customer_email" => $this->customerEmail,
            "customer_firstname" => $this->customerFirstname,
            "customer_gender" => $this->customerGender,
            "customer_group_id" => (string) $this->customerGroupId,
            "customer_id" => (string) $this->customerId,
            "customer_is_guest" => $this->customerIsGuest,
            "customer_lastname" => $this->customerLastname,
            "customer_middlename" => $this->customerMiddlename,
            "customer_note" => $this->customerNote,
            "customer_note_notify" => $this->customerNoteNotify,
            "customer_prefix" => $this->customerPrefix,
            "customer_suffix" => $this->customerSuffix,
            "customer_taxvat" => $this->customerTaxvat,
            "discount_amount" => $this->discountAmount,
            "discount_canceled" => $this->discountCanceled,
            "discount_description" => $this->discountDescription,
            "discount_invoiced" => $this->discountInvoiced,
            "discount_refunded" => $this->discountRefunded,
            "edit_increment" => $this->editIncrement,
            "email_sent" => $this->emailSent,
            "entity_id" => (string) $this->entityId,
            "ext_customer_id" => (string) $this->extCustomerId,
            "ext_order_id" => (string) $this->extOrderId,
            "forced_shipment_with_invoice" => $this->forcedShipmentWithInvoice,
            "global_currency_code" => $this->globalCurrencyCode,
            "grand_total" => $this->grandTotal,
            "discount_tax_compensation_amount" => $this->discountTaxCompensationAmount,
            "discount_tax_compensation_invoiced" => $this->discountTaxCompensationInvoiced,
            "discount_tax_compensation_refunded" => $this->discountTaxCompensationRefunded,
            "hold_before_state" => $this->holdBeforeState,
            "hold_before_status" => $this->holdBeforeStatus,
            "increment_id" =>(string) $this->incrementId,
            "is_virtual" => $this->isVirtual,
            "order_currency_code" => $this->orderCurrencyCode,
            "original_increment_id" => (string) $this->originalIncrementId,
            "payment_authorization_amount" => $this->paymentAuthorizationAmount,
            "payment_auth_expiration" => $this->paymentAuthExpiration,
            "protect_code" => $this->protectCode,
            "quote_address_id" => (string) $this->quoteAddressId,
            "quote_id" => (string) $this->quoteId,
            "relation_child_id" => (string) $this->relationChildId,
            "relation_child_real_id" => (string) $this->relationChildRealId,
            "relation_parent_id" => (string) $this->relationParentId,
            "relation_parent_real_id" => (string) $this->relationParentRealId,
            "remote_ip" => $this->remoteIp,
            "shipping_amount" => $this->shippingAmount,
            "shipping_canceled" => $this->shippingCanceled,
            "shipping_description" => $this->shippingDescription,
            "shipping_discount_amount" => $this->shippingDiscountAmount,
            "shipping_discount_tax_compensation_amount" => $this->shippingDiscountTaxCompensationAmount,
            "shipping_incl_tax" => $this->shippingInclTax,
            "shipping_invoiced" => $this->shippingInvoiced,
            "shipping_refunded" => $this->shippingRefunded,
            "shipping_tax_amount" => $this->shippingTaxAmount,
            "shipping_tax_refunded" => $this->shippingTaxRefunded,
            "state" => $this->state,
            "status" => $this->status,
            "store_currency_code" => $this->storeCurrencyCode,
            "store_id" => (string) $this->storeId,
            "store_name" => $this->storeName,
            "store_to_base_rate" => $this->storeToBaseRate,
            "store_to_order_rate" => $this->storeToOrderRate,
            "subtotal" => $this->subtotal,
            "subtotal_canceled" => $this->subtotalCanceled,
            "subtotal_incl_tax" => $this->subtotalInclTax,
            "subtotal_invoiced" => $this->subtotalInvoiced,
            "subtotal_refunded" => $this->subtotalRefunded,
            "tax_amount" => $this->taxAmount,
            "tax_canceled" => $this->taxCanceled,
            "tax_invoiced" => $this->taxInvoiced,
            "tax_refunded" => $this->taxRefunded,
            "total_canceled" => $this->totalCanceled,
            "total_due" => $this->totalDue,
            "total_invoiced" => $this->totalInvoiced,
            "total_item_count" => $this->totalItemCount,
            "total_offline_refunded" => $this->totalOfflineRefunded,
            "total_online_refunded" => $this->totalOnlineRefunded,
            "total_paid" => $this->totalPaid,
            "total_qty_ordered" => $this->totalQtyOrdered,
            "total_refunded" => $this->totalRefunded,
            "updated_at" => $this->updatedAt,
            "weight" => $this->weight,
            "x_forwarded_for" => $this->xForwardedFor,
            "items" => $this->items->toJson(),
            "billing_address" => $this->billingAddress !== null ? $this->billingAddress->toJson() : null,
            "payment" => $this->payment !== null ? $this->payment->toJson() : null,
            "status_histories" => $this->statusHistories->toJson(),
            "extension_attributes" => $this->extensionAttributes->toJson(),
        ];
    }


    private $adjustmentNegative;
    private $adjustmentPositive;
    private $appliedRuleIds;
    private $baseAdjustmentNegative;
    private $baseAdjustmentPositive;
    private $baseCurrencyCode;
    private $baseDiscountAmount;
    private $baseDiscountCanceled;
    private $baseDiscountInvoiced;
    private $baseDiscountRefunded;
    private $baseGrandTotal;
    private $baseDiscountTaxCompensationAmount;
    private $baseDiscountTaxCompensationInvoiced;
    private $baseDiscountTaxCompensationRefunded;
    private $baseShippingAmount;
    private $baseShippingCanceled;
    private $baseShippingDiscountAmount;
    private $baseShippingDiscountTaxCompensationAmnt;
    private $baseShippingInclTax;
    private $baseShippingInvoiced;
    private $baseShippingRefunded;
    private $baseShippingTaxAmount;
    private $baseShippingTaxRefunded;
    private $baseSubtotal;
    private $baseSubtotalCanceled;
    private $baseSubtotalInclTax;
    private $baseSubtotalInvoiced;
    private $baseSubtotalRefunded;
    private $baseTaxAmount;
    private $baseTaxCanceled;
    private $baseTaxInvoiced;
    private $baseTaxRefunded;
    private $baseTotalCanceled;
    private $baseTotalDue;
    private $baseTotalInvoiced;
    private $baseTotalInvoicedCost;
    private $baseTotalOfflineRefunded;
    private $baseTotalOnlineRefunded;
    private $baseTotalPaid;
    private $baseTotalQtyOrdered;
    private $baseTotalRefunded;
    private $baseToGlobalRate;
    private $baseToOrderRate;
    private $billingAddressId;
    private $canShipPartially;
    private $canShipPartiallyItem;
    private $couponCode;
    private $createdAt;
    private $customerDob;
    private $customerEmail;
    private $customerFirstname;
    private $customerGender;
    private $customerGroupId;
    private $customerId;
    private $customerIsGuest;
    private $customerLastname;
    private $customerMiddlename;
    private $customerNote;
    private $customerNoteNotify;
    private $customerPrefix;
    private $customerSuffix;
    private $customerTaxvat;
    private $discountAmount;
    private $discountCanceled;
    private $discountDescription;
    private $discountInvoiced;
    private $discountRefunded;
    private $editIncrement;
    private $emailSent;
    private $entityId;
    private $extCustomerId;
    private $extOrderId;
    private $forcedShipmentWithInvoice;
    private $globalCurrencyCode;
    private $grandTotal;
    private $discountTaxCompensationAmount;
    private $discountTaxCompensationInvoiced;
    private $discountTaxCompensationRefunded;
    private $holdBeforeState;
    private $holdBeforeStatus;
    private $incrementId;
    private $isVirtual;
    private $orderCurrencyCode;
    private $originalIncrementId;
    private $paymentAuthorizationAmount;
    private $paymentAuthExpiration;
    private $protectCode;
    private $quoteAddressId;
    private $quoteId;
    private $relationChildId;
    private $relationChildRealId;
    private $relationParentId;
    private $relationParentRealId;
    private $remoteIp;
    private $shippingAmount;
    private $shippingCanceled;
    private $shippingDescription;
    private $shippingDiscountAmount;
    private $shippingDiscountTaxCompensationAmount;
    private $shippingInclTax;
    private $shippingInvoiced;
    private $shippingRefunded;
    private $shippingTaxAmount;
    private $shippingTaxRefunded;
    private $state;
    private $status;
    private $storeCurrencyCode;
    private $storeId;
    private $storeName;
    private $storeToBaseRate;
    private $storeToOrderRate;
    private $subtotal;
    private $subtotalCanceled;
    private $subtotalInclTax;
    private $subtotalInvoiced;
    private $subtotalRefunded;
    private $taxAmount;
    private $taxCanceled;
    private $taxInvoiced;
    private $taxRefunded;
    private $totalCanceled;
    private $totalDue;
    private $totalInvoiced;
    private $totalItemCount;
    private $totalOfflineRefunded;
    private $totalOnlineRefunded;
    private $totalPaid;
    private $totalQtyOrdered;
    private $totalRefunded;
    private $updatedAt;
    private $weight;
    private $xForwardedFor;
    /** @var  ItemDataCollection */
    private $items;
    /** @var  AddressData */
    private $billingAddress;
    /** @var  PaymentData */
    private $payment;
    /** @var  StatusHistoryDataCollection */
    private $statusHistories;
    /** @var  ExtensionAttributeSet */
    private $extensionAttributes;

    private function __construct()
    {
        $this->extensionAttributes = ExtensionAttributeSet::create();
        $this->items = ItemDataCollection::create();
        $this->statusHistories = StatusHistoryDataCollection::create();
    }

    public function equals($object): bool
    {
        return $object instanceof self &&
        $this->adjustmentNegative === $object->adjustmentNegative &&
        $this->adjustmentPositive === $object->adjustmentPositive &&
        $this->appliedRuleIds === $object->appliedRuleIds &&
        $this->baseAdjustmentNegative === $object->baseAdjustmentNegative &&
        $this->baseAdjustmentPositive === $object->baseAdjustmentPositive &&
        $this->baseCurrencyCode === $object->baseCurrencyCode &&
        $this->baseDiscountAmount === $object->baseDiscountAmount &&
        $this->baseDiscountCanceled === $object->baseDiscountCanceled &&
        $this->baseDiscountInvoiced === $object->baseDiscountInvoiced &&
        $this->baseDiscountRefunded === $object->baseDiscountRefunded &&
        $this->baseGrandTotal === $object->baseGrandTotal &&
        $this->baseDiscountTaxCompensationAmount === $object->baseDiscountTaxCompensationAmount &&
        $this->baseDiscountTaxCompensationInvoiced === $object->baseDiscountTaxCompensationInvoiced &&
        $this->baseDiscountTaxCompensationRefunded === $object->baseDiscountTaxCompensationRefunded &&
        $this->baseShippingAmount === $object->baseShippingAmount &&
        $this->baseShippingCanceled === $object->baseShippingCanceled &&
        $this->baseShippingDiscountAmount === $object->baseShippingDiscountAmount &&
        $this->baseShippingDiscountTaxCompensationAmnt === $object->baseShippingDiscountTaxCompensationAmnt &&
        $this->baseShippingInclTax === $object->baseShippingInclTax &&
        $this->baseShippingInvoiced === $object->baseShippingInvoiced &&
        $this->baseShippingRefunded === $object->baseShippingRefunded &&
        $this->baseShippingTaxAmount === $object->baseShippingTaxAmount &&
        $this->baseShippingTaxRefunded === $object->baseShippingTaxRefunded &&
        $this->baseSubtotal === $object->baseSubtotal &&
        $this->baseSubtotalCanceled === $object->baseSubtotalCanceled &&
        $this->baseSubtotalInclTax === $object->baseSubtotalInclTax &&
        $this->baseSubtotalInvoiced === $object->baseSubtotalInvoiced &&
        $this->baseSubtotalRefunded === $object->baseSubtotalRefunded &&
        $this->baseTaxAmount === $object->baseTaxAmount &&
        $this->baseTaxCanceled === $object->baseTaxCanceled &&
        $this->baseTaxInvoiced === $object->baseTaxInvoiced &&
        $this->baseTaxRefunded === $object->baseTaxRefunded &&
        $this->baseTotalCanceled === $object->baseTotalCanceled &&
        $this->baseTotalDue === $object->baseTotalDue &&
        $this->baseTotalInvoiced === $object->baseTotalInvoiced &&
        $this->baseTotalInvoicedCost === $object->baseTotalInvoicedCost &&
        $this->baseTotalOfflineRefunded === $object->baseTotalOfflineRefunded &&
        $this->baseTotalOnlineRefunded === $object->baseTotalOnlineRefunded &&
        $this->baseTotalPaid === $object->baseTotalPaid &&
        $this->baseTotalQtyOrdered === $object->baseTotalQtyOrdered &&
        $this->baseTotalRefunded === $object->baseTotalRefunded &&
        $this->baseToGlobalRate === $object->baseToGlobalRate &&
        $this->baseToOrderRate === $object->baseToOrderRate &&
        $this->billingAddressId === $object->billingAddressId &&
        $this->canShipPartially === $object->canShipPartially &&
        $this->canShipPartiallyItem === $object->canShipPartiallyItem &&
        $this->couponCode === $object->couponCode &&
        $this->createdAt === $object->createdAt &&
        $this->customerDob === $object->customerDob &&
        $this->customerEmail === $object->customerEmail &&
        $this->customerFirstname === $object->customerFirstname &&
        $this->customerGender === $object->customerGender &&
        $this->customerGroupId === $object->customerGroupId &&
        $this->customerId === $object->customerId &&
        $this->customerIsGuest === $object->customerIsGuest &&
        $this->customerLastname === $object->customerLastname &&
        $this->customerMiddlename === $object->customerMiddlename &&
        $this->customerNote === $object->customerNote &&
        $this->customerNoteNotify === $object->customerNoteNotify &&
        $this->customerPrefix === $object->customerPrefix &&
        $this->customerSuffix === $object->customerSuffix &&
        $this->customerTaxvat === $object->customerTaxvat &&
        $this->discountAmount === $object->discountAmount &&
        $this->discountCanceled === $object->discountCanceled &&
        $this->discountDescription === $object->discountDescription &&
        $this->discountInvoiced === $object->discountInvoiced &&
        $this->discountRefunded === $object->discountRefunded &&
        $this->editIncrement === $object->editIncrement &&
        $this->emailSent === $object->emailSent &&
        $this->entityId === $object->entityId &&
        $this->extCustomerId === $object->extCustomerId &&
        $this->extOrderId === $object->extOrderId &&
        $this->forcedShipmentWithInvoice === $object->forcedShipmentWithInvoice &&
        $this->globalCurrencyCode === $object->globalCurrencyCode &&
        $this->grandTotal === $object->grandTotal &&
        $this->discountTaxCompensationAmount === $object->discountTaxCompensationAmount &&
        $this->discountTaxCompensationInvoiced === $object->discountTaxCompensationInvoiced &&
        $this->discountTaxCompensationRefunded === $object->discountTaxCompensationRefunded &&
        $this->holdBeforeState === $object->holdBeforeState &&
        $this->holdBeforeStatus === $object->holdBeforeStatus &&
        $this->incrementId === $object->incrementId &&
        $this->isVirtual === $object->isVirtual &&
        $this->orderCurrencyCode === $object->orderCurrencyCode &&
        $this->originalIncrementId === $object->originalIncrementId &&
        $this->paymentAuthorizationAmount === $object->paymentAuthorizationAmount &&
        $this->paymentAuthExpiration === $object->paymentAuthExpiration &&
        $this->protectCode === $object->protectCode &&
        $this->quoteAddressId === $object->quoteAddressId &&
        $this->quoteId === $object->quoteId &&
        $this->relationChildId === $object->relationChildId &&
        $this->relationChildRealId === $object->relationChildRealId &&
        $this->relationParentId === $object->relationParentId &&
        $this->relationParentRealId === $object->relationParentRealId &&
        $this->remoteIp === $object->remoteIp &&
        $this->shippingAmount === $object->shippingAmount &&
        $this->shippingCanceled === $object->shippingCanceled &&
        $this->shippingDescription === $object->shippingDescription &&
        $this->shippingDiscountAmount === $object->shippingDiscountAmount &&
        $this->shippingDiscountTaxCompensationAmount === $object->shippingDiscountTaxCompensationAmount &&
        $this->shippingInclTax === $object->shippingInclTax &&
        $this->shippingInvoiced === $object->shippingInvoiced &&
        $this->shippingRefunded === $object->shippingRefunded &&
        $this->shippingTaxAmount === $object->shippingTaxAmount &&
        $this->shippingTaxRefunded === $object->shippingTaxRefunded &&
        $this->state === $object->state &&
        $this->status === $object->status &&
        $this->storeCurrencyCode === $object->storeCurrencyCode &&
        $this->storeId === $object->storeId &&
        $this->storeName === $object->storeName &&
        $this->storeToBaseRate === $object->storeToBaseRate &&
        $this->storeToOrderRate === $object->storeToOrderRate &&
        $this->subtotal === $object->subtotal &&
        $this->subtotalCanceled === $object->subtotalCanceled &&
        $this->subtotalInclTax === $object->subtotalInclTax &&
        $this->subtotalInvoiced === $object->subtotalInvoiced &&
        $this->subtotalRefunded === $object->subtotalRefunded &&
        $this->taxAmount === $object->taxAmount &&
        $this->taxCanceled === $object->taxCanceled &&
        $this->taxInvoiced === $object->taxInvoiced &&
        $this->taxRefunded === $object->taxRefunded &&
        $this->totalCanceled === $object->totalCanceled &&
        $this->totalDue === $object->totalDue &&
        $this->totalInvoiced === $object->totalInvoiced &&
        $this->totalItemCount === $object->totalItemCount &&
        $this->totalOfflineRefunded === $object->totalOfflineRefunded &&
        $this->totalOnlineRefunded === $object->totalOnlineRefunded &&
        $this->totalPaid === $object->totalPaid &&
        $this->totalQtyOrdered === $object->totalQtyOrdered &&
        $this->totalRefunded === $object->totalRefunded &&
        $this->updatedAt === $object->updatedAt &&
        $this->weight === $object->weight &&
        $this->xForwardedFor === $object->xForwardedFor &&
        $this->items->equals($object->items) &&
        $this->billingAddress->equals($object->billingAddress) &&
        $this->payment->equals($object->payment) &&
        $this->statusHistories->equals($object->statusHistories) &&
        $this->extensionAttributes->equals($object->extensionAttributes);
    }
}
