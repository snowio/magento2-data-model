<?php

namespace SnowIO\Magento2DataModel\CreditMemo;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;

class CreditMemoItemData
{
    public static function fromJson(array $json): self
    {
        return new self($json);
    }

    public function getAdditionalData()
    {
        return $this->data['additional_data'] ?? null;
    }

    public function getBaseCost()
    {
        return $this->data['base_cost'] ?? null;
    }

    public function getBaseDiscountAmount()
    {
        return $this->data['base_discount_amount'] ?? null;
    }

    public function getBaseDiscountTaxCompensationAmount()
    {
        return $this->data['base_discount_tax_compensation_amount'] ?? null;
    }

    public function getBasePrice()
    {
        return $this->data['base_price'] ?? null;
    }

    public function getBasePriceInclTax()
    {
        return $this->data['base_price_incl_tax'] ?? null;
    }

    public function getBaseRowTotal()
    {
        return $this->data['base_row_total'] ?? null;
    }

    public function getBaseRowTotalInclTax()
    {
        return $this->data['base_row_total_incl_tax'] ?? null;
    }

    public function getBaseTaxAmount()
    {
        return $this->data['base_tax_amount'] ?? null;
    }

    public function getBaseWeeeTaxAppliedAmount()
    {
        return $this->data['base_weee_tax_applied_amount'] ?? null;
    }

    public function getBaseWeeeTaxAppliedRowAmnt()
    {
        return $this->data['base_weee_tax_applied_row_amnt'] ?? null;
    }

    public function getBaseWeeeTaxDisposition()
    {
        return $this->data['base_weee_tax_disposition'] ?? null;
    }

    public function getBaseWeeeTaxRowDisposition()
    {
        return $this->data['base_weee_tax_row_disposition'] ?? null;
    }

    public function getDescription()
    {
        return $this->data['description'] ?? null;
    }

    public function getDiscountAmount()
    {
        return $this->data['discount_amount'] ?? null;
    }

    public function getEntityId()
    {
        return $this->data['entity_id'] ?? null;
    }

    public function getDiscountTaxCompensationAmount()
    {
        return $this->data['discount_tax_compensation_amount'] ?? null;
    }

    public function getName()
    {
        return $this->data['name'] ?? null;
    }

    public function getOrderItemId()
    {
        return $this->data['order_item_id'] ?? null;
    }

    public function getParentId()
    {
        return $this->data['parent_id'] ?? null;
    }

    public function getPrice()
    {
        return $this->data['price'] ?? null;
    }

    public function getPriceInclTax()
    {
        return $this->data['price_incl_tax'] ?? null;
    }

    public function getProductId()
    {
        return $this->data['product_id'] ?? null;
    }

    public function getQty()
    {
        return $this->data['qty'] ?? null;
    }

    public function getRowTotal()
    {
        return $this->data['row_total'] ?? null;
    }

    public function getRowTotalInclTax()
    {
        return $this->data['row_total_incl_tax'] ?? null;
    }

    public function getSku()
    {
        return $this->data['sku'] ?? null;
    }

    public function getTaxAmount()
    {
        return $this->data['tax_amount'] ?? null;
    }

    public function getWeeeTaxApplied()
    {
        return $this->data['weee_tax_applied'] ?? null;
    }

    public function getWeeeTaxAppliedAmount()
    {
        return $this->data['weee_tax_applied_amount'] ?? null;
    }

    public function getWeeeTaxAppliedRowAmount()
    {
        return $this->data['weee_tax_applied_row_amount'] ?? null;
    }

    public function getWeeeTaxDisposition()
    {
        return $this->data['weee_tax_disposition'] ?? null;
    }

    public function getWeeeTaxRowDisposition()
    {
        return $this->data['weee_tax_row_disposition'] ?? null;
    }

    public function getExtensionAttributes()
    {
        return $this->data['extension_attributes'] ?? null;
    }

    public function withAdditionalData($additionalData)
    {
        $result = clone $this;
        $result->data['additional_data'] = $additionalData;
        return $result;
    }

    public function withBaseCost($baseCost)
    {
        $result = clone $this;
        $result->data['base_cost'] = $baseCost;
        return $result;
    }

    public function withBaseDiscountAmount($baseDiscountAmount)
    {
        $result = clone $this;
        $result->data['base_discount_amount'] = $baseDiscountAmount;
        return $result;
    }

    public function withBaseDiscountTaxCompensationAmount($baseDiscountTaxCompensationAmount)
    {
        $result = clone $this;
        $result->data['base_discount_tax_compensation_amount'] = $baseDiscountTaxCompensationAmount;
        return $result;
    }

    public function withBasePrice($basePrice)
    {
        $result = clone $this;
        $result->data['base_price'] = $basePrice;
        return $result;
    }

    public function withBasePriceInclTax($basePriceInclTax)
    {
        $result = clone $this;
        $result->data['base_price_incl_tax'] = $basePriceInclTax;
        return $result;
    }

    public function withBaseRowTotal($baseRowTotal)
    {
        $result = clone $this;
        $result->data['base_row_total'] = $baseRowTotal;
        return $result;
    }

    public function withBaseRowTotalInclTax($baseRowTotalInclTax)
    {
        $result = clone $this;
        $result->data['base_row_total_incl_tax'] = $baseRowTotalInclTax;
        return $result;
    }

    public function withBaseTaxAmount($baseTaxAmount)
    {
        $result = clone $this;
        $result->data['base_tax_amount'] = $baseTaxAmount;
        return $result;
    }

    public function withBaseWeeeTaxAppliedAmount($baseWeeeTaxAppliedAmount)
    {
        $result = clone $this;
        $result->data['base_weee_tax_applied_amount'] = $baseWeeeTaxAppliedAmount;
        return $result;
    }

    public function withBaseWeeeTaxAppliedRowAmnt($baseWeeeTaxAppliedRowAmnt)
    {
        $result = clone $this;
        $result->data['base_weee_tax_applied_row_amnt'] = $baseWeeeTaxAppliedRowAmnt;
        return $result;
    }

    public function withBaseWeeeTaxDisposition($baseWeeeTaxDisposition)
    {
        $result = clone $this;
        $result->data['base_weee_tax_disposition'] = $baseWeeeTaxDisposition;
        return $result;
    }

    public function withBaseWeeeTaxRowDisposition($baseWeeeTaxRowDisposition)
    {
        $result = clone $this;
        $result->data['base_weee_tax_row_disposition'] = $baseWeeeTaxRowDisposition;
        return $result;
    }

    public function withDescription($description)
    {
        $result = clone $this;
        $result->data['description'] = $description;
        return $result;
    }

    public function withDiscountAmount($discountAmount)
    {
        $result = clone $this;
        $result->data['discount_amount'] = $discountAmount;
        return $result;
    }

    public function withEntityId($entityId)
    {
        $result = clone $this;
        $result->data['entity_id'] = $entityId;
        return $result;
    }

    public function withDiscountTaxCompensationAmount($discountTaxCompensationAmount)
    {
        $result = clone $this;
        $result->data['discount_tax_compensation_amount'] = $discountTaxCompensationAmount;
        return $result;
    }

    public function withName($name)
    {
        $result = clone $this;
        $result->data['name'] = $name;
        return $result;
    }

    public function withOrderItemId($orderItemId)
    {
        $result = clone $this;
        $result->data['order_item_id'] = $orderItemId;
        return $result;
    }

    public function withParentId($parentId)
    {
        $result = clone $this;
        $result->data['parent_id'] = $parentId;
        return $result;
    }

    public function withPrice($price)
    {
        $result = clone $this;
        $result->data['price'] = $price;
        return $result;
    }

    public function withPriceInclTax($priceInclTax)
    {
        $result = clone $this;
        $result->data['price_incl_tax'] = $priceInclTax;
        return $result;
    }

    public function withProductId($productId)
    {
        $result = clone $this;
        $result->data['product_id'] = $productId;
        return $result;
    }

    public function withQty($qty)
    {
        $result = clone $this;
        $result->data['qty'] = $qty;
        return $result;
    }

    public function withRowTotal($rowTotal)
    {
        $result = clone $this;
        $result->data['row_total'] = $rowTotal;
        return $result;
    }

    public function withRowTotalInclTax($rowTotalInclTax)
    {
        $result = clone $this;
        $result->data['row_total_incl_tax'] = $rowTotalInclTax;
        return $result;
    }

    public function withSku($sku)
    {
        $result = clone $this;
        $result->data['sku'] = $sku;
        return $result;
    }

    public function withTaxAmount($taxAmount)
    {
        $result = clone $this;
        $result->data['tax_amount'] = $taxAmount;
        return $result;
    }

    public function withWeeeTaxApplied($weeeTaxApplied)
    {
        $result = clone $this;
        $result->data['weee_tax_applied'] = $weeeTaxApplied;
        return $result;
    }

    public function withWeeeTaxAppliedAmount($weeeTaxAppliedAmount)
    {
        $result = clone $this;
        $result->data['weee_tax_applied_amount'] = $weeeTaxAppliedAmount;
        return $result;
    }

    public function withWeeeTaxAppliedRowAmount($weeeTaxAppliedRowAmount)
    {
        $result = clone $this;
        $result->data['weee_tax_applied_row_amount'] = $weeeTaxAppliedRowAmount;
        return $result;
    }

    public function withWeeeTaxDisposition($weeeTaxDisposition)
    {
        $result = clone $this;
        $result->data['weee_tax_disposition'] = $weeeTaxDisposition;
        return $result;
    }

    public function withWeeeTaxRowDisposition($weeeTaxRowDisposition)
    {
        $result = clone $this;
        $result->data['weee_tax_row_disposition'] = $weeeTaxRowDisposition;
        return $result;
    }

    public function withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
    {
        $result = clone $this;
        $result->data['extension_attributes'] = $extensionAttributes;
        return $result;
    }

    private $data = [];

    private function __construct(array $data)
    {
        $this->data = $data;
        $this->data['extension_attributes'] =
            ExtensionAttributeSet::fromJson($this->data['extension_attributes'] ?? []);
    }

    public function toJson()
    {
        return array_merge(
            $this->data,
            [
                'extension_attributes' =>
                    $this->data['extension_attributes'] === null ?
                        [] : $this->data['extension_attributes']->toJson()
            ]
        );
    }

    public function equals($otherItemData)
    {
        return $otherItemData instanceof self && $otherItemData->data == $this->data;
    }
}