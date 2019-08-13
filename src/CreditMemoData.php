<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\CreditMemo\CreditMemoItemCollection;

final class CreditMemoData implements ValueObject
{
    public function GetAdjustment()
    {
        return $this->data['adjustment'] ?? null;
    }

    public function getItems()
    {
        return $this->data['items'] ?? null;
    }

    public function getAdjustmentNegative()
    {
        return $this->data['adjustment_negative'] ?? null;
    }

    public function getAdjustmentPositive()
    {
        return $this->data['adjustment_positive'] ?? null;
    }

    public function getBaseAdjustment()
    {
        return $this->data['base_adjustment'] ?? null;
    }

    public function getBaseAdjustmentNegative()
    {
        return $this->data['base_adjustment_negative'] ?? null;
    }

    public function getBaseAdjustmentPositive()
    {
        return $this->data['base_adjustment_positive'] ?? null;
    }

    public function getBaseCurrencyCode()
    {
        return $this->data['base_currency_code'] ?? null;
    }

    public function getBaseDiscountAmount()
    {
        return $this->data['base_discount_amount'] ?? null;
    }

    public function getBaseGrandTotal()
    {
        return $this->data['base_grand_total'] ?? null;
    }

    public function getBaseDiscountTaxCompensation_amount()
    {
        return $this->data['base_discount_tax_compensation_amount'] ?? null;
    }

    public function getBaseShippingAmount()
    {
        return $this->data['base_shipping_amount'] ?? null;
    }

    public function getBaseShippingDiscountTaxCompensationAmnt()
    {
        return $this->data['base_shipping_discount_tax_compensation_amnt'] ?? null;
    }

    public function getBaseShippingInclTax()
    {
        return $this->data['base_shipping_incl_tax'] ?? null;
    }

    public function getBaseShippingTaxAmount()
    {
        return $this->data['base_shipping_tax_amount'] ?? null;
    }

    public function getBaseSubtotal()
    {
        return $this->data['base_subtotal'] ?? null;
    }

    public function getBaseSubtotalInclTax()
    {
        return $this->data['base_subtotal_incl_tax'] ?? null;
    }

    public function getBaseTaxAmount()
    {
        return $this->data['base_tax_amount'] ?? null;
    }

    public function getBaseToGlobalRate()
    {
        return $this->data['base_to_global_rate'] ?? null;
    }

    public function getBaseToOrderRate()
    {
        return $this->data['base_to_order_rate'] ?? null;
    }

    public function getBillingAddressId()
    {
        return $this->data['billing_address_id'] ?? null;
    }

    public function getCreatedAt()
    {
        return $this->data['created_at'] ?? null;
    }

    public function getCreditMemoStatus()
    {
        return $this->data['creditmemo_status'] ?? null;
    }

    public function getDiscountAmount()
    {
        return $this->data['discount_amount'] ?? null;
    }

    public function getDiscountDescription()
    {
        return $this->data['discount_description'] ?? null;
    }

    public function getEmailSent()
    {
        return $this->data['email_sent'] ?? null;
    }

    public function getEntityId()
    {
        return $this->data['entity_id'] ?? null;
    }

    public function getGlobalCurrencyCode()
    {
        return $this->data['global_currency_code'] ?? null;
    }

    public function getGrandTotal()
    {
        return $this->data['grand_total'] ?? null;
    }

    public function getDiscountTaxCompensationAmount()
    {
        return $this->data['discount_tax_compensation_amount'] ?? null;
    }

    public function getIncrementId()
    {
        return $this->data['increment_id'] ?? null;
    }

    public function getInvoiceId()
    {
        return $this->data['invoice_id'] ?? null;
    }

    public function getOrderCurrencyCode()
    {
        return $this->data['order_currency_code'] ?? null;
    }

    public function getOrderId()
    {
        return $this->data['order_id'] ?? null;
    }

    public function getShippingAddressId()
    {
        return $this->data['shipping_address_id'] ?? null;
    }

    public function getShippingAmount()
    {
        return $this->data['shipping_amount'] ?? null;
    }

    public function getShippingDiscountTaxCompensationAmount()
    {
        return $this->data['shipping_discount_tax_compensation_amount'] ?? null;
    }

    public function getShippingInclTax()
    {
        return $this->data['shipping_incl_tax'] ?? null;
    }

    public function getShippingTaxAmount()
    {
        return $this->data['shipping_tax_amount'] ?? null;
    }

    public function getState()
    {
        return $this->data['state'] ?? null;
    }

    public function getStoreCurrencyCode()
    {
        return $this->data['store_currency_code'] ?? null;
    }

    public function getStoreId()
    {
        return $this->data['store_id'] ?? null;
    }

    public function getStoreToBaseRate()
    {
        return $this->data['store_to_base_rate'] ?? null;
    }

    public function getStoreToOrderRate()
    {
        return $this->data['store_to_order_rate'] ?? null;
    }

    public function getSubtotal()
    {
        return $this->data['subtotal'] ?? null;
    }

    public function getSubtotalInclTax()
    {
        return $this->data['subtotal_incl_tax'] ?? null;
    }

    public function getTaxAmount()
    {
        return $this->data['tax_amount'] ?? null;
    }

    public function getTransactionId()
    {
        return $this->data['transaction_id'] ?? null;
    }

    public function getUpdatedAt()
    {
        return $this->data['updated_at'] ?? null;
    }

    public function getExtensionAttributes()
    {
        return $this->data['extension_attributes'] ?? null;
    }

    public function withItems($items)
    {
        $result = clone $this;
        $this->data['items'] = $items;
        return $result;
    }

    public function withAdjustment($adjustment)
    {
        $result = clone $this;
        $result->data['adjustment'] = $adjustment;
        return $result;
    }

    public function withAdjustmentNegative($adjustmentNegative)
    {
        $result = clone $this;
        $result->data['adjustment_negative'] = $adjustmentNegative;
        return $result;
    }

    public function withAdjustmentPositive($adjustmentPositive)
    {
        $result = clone $this;
        $result->data['adjustment_positive'] = $adjustmentPositive;
        return $result;
    }

    public function withBaseAdjustment($baseAdjustment)
    {
        $result = clone $this;
        $result->data['base_adjustment'] = $baseAdjustment;
        return $result;
    }

    public function withBaseAdjustmentNegative($baseAdjustmentNegative)
    {
        $result = clone $this;
        $result->data['base_adjustment_negative'] = $baseAdjustmentNegative;
        return $result;
    }

    public function withBaseAdjustmentPositive($baseAdjustmentPositive)
    {
        $result = clone $this;
        $result->data['base_adjustment_positive'] = $baseAdjustmentPositive;
        return $result;
    }

    public function withBaseCurrencyCode($baseCurrencyCode)
    {
        $result = clone $this;
        $result->data['base_currency_code'] = $baseCurrencyCode;
        return $result;
    }

    public function withBaseDiscountAmount($baseDiscountAmount)
    {
        $result = clone $this;
        $result->data['base_discount_amount'] = $baseDiscountAmount;
        return $result;
    }

    public function withBaseGrandTotal($baseGrandTotal)
    {
        $result = clone $this;
        $result->data['base_grand_total'] = $baseGrandTotal;
        return $result;
    }

    public function withBaseDiscountTaxCompensationAmount($baseDiscountTaxCompensationAmount)
    {
        $result = clone $this;
        $result->data['base_discount_tax_compensation_amount'] = $baseDiscountTaxCompensationAmount;
        return $result;
    }

    public function withBaseShippingAmount($baseShippingAmount)
    {
        $result = clone $this;
        $result->data['base_shipping_amount'] = $baseShippingAmount;
        return $result;
    }

    public function withBaseShippingDiscountTaxCompensationAmnt($baseShippingDiscountTaxCompensationAmnt)
    {
        $result = clone $this;
        $result->data['base_shipping_discount_tax_compensation_amnt'] = $baseShippingDiscountTaxCompensationAmnt;
        return $result;
    }

    public function withBaseShippingInclTax($baseShippingInclTax)
    {
        $result = clone $this;
        $result->data['base_shipping_incl_tax'] = $baseShippingInclTax;
        return $result;
    }

    public function withBaseShippingTaxAmount($baseShippingTaxAmount)
    {
        $result = clone $this;
        $result->data['base_shipping_tax_amount'] = $baseShippingTaxAmount;
        return $result;
    }

    public function withBaseSubtotal($baseSubtotal)
    {
        $result = clone $this;
        $result->data['base_subtotal'] = $baseSubtotal;
        return $result;
    }

    public function withBaseSubtotalInclTax($baseSubtotalInclTax)
    {
        $result = clone $this;
        $result->data['base_subtotal_incl_tax'] = $baseSubtotalInclTax;
        return $result;
    }

    public function withBaseTaxAmount($baseTaxAmount)
    {
        $result = clone $this;
        $result->data['base_tax_amount'] = $baseTaxAmount;
        return $result;
    }

    public function withBaseToGlobalRate($baseToGlobalRate)
    {
        $result = clone $this;
        $result->data['base_to_global_rate'] = $baseToGlobalRate;
        return $result;
    }

    public function withBaseToOrderRate($baseToOrderRate)
    {
        $result = clone $this;
        $result->data['base_to_order_rate'] = $baseToOrderRate;
        return $result;
    }

    public function withBillingAddressId($billingAddressId)
    {
        $result = clone $this;
        $result->data['billing_address_id'] = $billingAddressId;
        return $result;
    }

    public function withCreatedAt($createdAt)
    {
        $result = clone $this;
        $result->data['created_at'] = $createdAt;
        return $result;
    }

    public function withCreditmemoStatus($creditmemoStatus)
    {
        $result = clone $this;
        $result->data['creditmemo_status'] = $creditmemoStatus;
        return $result;
    }

    public function withDiscountAmount($discountAmount)
    {
        $result = clone $this;
        $result->data['discount_amount'] = $discountAmount;
        return $result;
    }

    public function withDiscountDescription($discountDescription)
    {
        $result = clone $this;
        $result->data['discount_description'] = $discountDescription;
        return $result;
    }

    public function withEmailSent($emailSent)
    {
        $result = clone $this;
        $result->data['email_sent'] = $emailSent;
        return $result;
    }

    public function withEntityId($entityId)
    {
        $result = clone $this;
        $result->data['entity_id'] = $entityId;
        return $result;
    }

    public function withGlobalCurrencyCode($globalCurrencyCode)
    {
        $result = clone $this;
        $result->data['global_currency_code'] = $globalCurrencyCode;
        return $result;
    }

    public function withGrandTotal($grandTotal)
    {
        $result = clone $this;
        $result->data['grand_total'] = $grandTotal;
        return $result;
    }

    public function withDiscountTaxCompensationAmount($discountTaxCompensationAmount)
    {
        $result = clone $this;
        $result->data['discount_tax_compensation_amount'] = $discountTaxCompensationAmount;
        return $result;
    }

    public function withIncrementId($incrementId)
    {
        $result = clone $this;
        $result->data['increment_id'] = $incrementId;
        return $result;
    }

    public function withInvoiceId($invoiceId)
    {
        $result = clone $this;
        $result->data['invoice_id'] = $invoiceId;
        return $result;
    }

    public function withOrderCurrencyCode($orderCurrencyCode)
    {
        $result = clone $this;
        $result->data['order_currency_code'] = $orderCurrencyCode;
        return $result;
    }

    public function withOrderId($orderId)
    {
        $result = clone $this;
        $result->data['order_id'] = $orderId;
        return $result;
    }

    public function withShippingAddressId($shippingAddressId)
    {
        $result = clone $this;
        $result->data['shipping_address_id'] = $shippingAddressId;
        return $result;
    }

    public function withShippingAmount($shippingAmount)
    {
        $result = clone $this;
        $result->data['shipping_amount'] = $shippingAmount;
        return $result;
    }

    public function withShippingDiscountTaxCompensationAmount($shippingDiscountTaxCompensationAmount)
    {
        $result = clone $this;
        $result->data['shipping_discount_tax_compensation_amount'] = $shippingDiscountTaxCompensationAmount;
        return $result;
    }

    public function withShippingInclTax($shippingInclTax)
    {
        $result = clone $this;
        $result->data['shipping_incl_tax'] = $shippingInclTax;
        return $result;
    }

    public function withShippingTaxAmount($shippingTaxAmount)
    {
        $result = clone $this;
        $result->data['shipping_tax_amount'] = $shippingTaxAmount;
        return $result;
    }

    public function withState($state)
    {
        $result = clone $this;
        $result->data['state'] = $state;
        return $result;
    }

    public function withStoreCurrencyCode($storeCurrencyCode)
    {
        $result = clone $this;
        $result->data['store_currency_code'] = $storeCurrencyCode;
        return $result;
    }

    public function withStoreId($storeId)
    {
        $result = clone $this;
        $result->data['store_id'] = $storeId;
        return $result;
    }

    public function withStoreToBaseRate($storeToBaseRate)
    {
        $result = clone $this;
        $result->data['store_to_base_rate'] = $storeToBaseRate;
        return $result;
    }

    public function withStoreToOrderRate($storeToOrderRate)
    {
        $result = clone $this;
        $result->data['store_to_order_rate'] = $storeToOrderRate;
        return $result;
    }

    public function withSubtotal($subtotal)
    {
        $result = clone $this;
        $result->data['subtotal'] = $subtotal;
        return $result;
    }

    public function withSubtotalInclTax($subtotalInclTax)
    {
        $result = clone $this;
        $result->data['subtotal_incl_tax'] = $subtotalInclTax;
        return $result;
    }

    public function withTaxAmount($taxAmount)
    {
        $result = clone $this;
        $result->data['tax_amount'] = $taxAmount;
        return $result;
    }

    public function withTransactionId($transactionId)
    {
        $result = clone $this;
        $result->data['transaction_id'] = $transactionId;
        return $result;
    }

    public function withUpdatedAt($updatedAt)
    {
        $result = clone $this;
        $result->data['updated_at'] = $updatedAt;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        $result->data['extension_attributes'] = $extensionAttributes;
        return $result;
    }

    public static function fromJson(array $json)
    {
        return new self($json);
    }

    private $data = [];

    private function __construct($data)
    {
        $this->data = $data;
        $this->data['items'] = CreditMemoItemCollection::fromJson($this->data['items']);
        $this->data['extension_attributes'] =
            ExtensionAttributeSet::fromJson($this->data['extension_attributes'] ?? []);
    }

    public function equals($object): bool
    {
        return $object instanceof self && $object->data == $this->data;
    }

    public function toJson()
    {
        return  array_merge(
            $this->data,
            ['items' => $this->data['items'] === null ? [] : $this->data['items']->toJson()],
            ['extension_attributes' => $this->data['extension_attributes'] === null ? [] : $this->data['extension_attributes']->toJson()]
        );
    }
}