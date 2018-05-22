<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Order;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\ValueObject;

final class ItemData implements ValueObject
{
    public static function of(string $sku)
    {
        return new self($sku);
    }
    
    public static function fromJson(array $json): self
    {
        $result = new self($json['sku']);
        $result->additionalData = (string)( $json['additional_data'] ?? null);
        $result->amountRefunded = (string)( $json['amount_refunded'] ?? null);
        $result->appliedRuleIds = (string)( $json['applied_rule_ids'] ?? null);
        $result->baseAmountRefunded = (string)( $json['base_amount_refunded'] ?? null);
        $result->baseCost =(string)(  $json['base_cost'] ?? null);
        $result->baseDiscountAmount = (string)( $json['base_discount_amount'] ?? null);
        $result->baseDiscountInvoiced = (string)( $json['base_discount_invoiced'] ?? null);
        $result->baseDiscountRefunded = (string)( $json['base_discount_refunded'] ?? null);
        $result->baseDiscountTaxCompensationAmount = (string)( $json['base_discount_tax_compensation_amount'] ?? null);
        $result->baseDiscountTaxCompensationInvoiced =
            (string)(  $json['base_discount_tax_compensation_invoiced'] ?? null);
        $result->baseDiscountTaxCompensationRefunded =
            (string)( $json['base_discount_tax_compensation_refunded'] ?? null);
        $result->baseOriginalPrice = (string)( $json['base_original_price'] ?? null);
        $result->basePrice =(string)(  $json['base_price'] ?? null);
        $result->basePriceInclTax = (string)( $json['base_price_incl_tax'] ?? null);
        $result->baseRowInvoiced =(string)(  $json['base_row_invoiced'] ?? null);
        $result->baseRowTotal = (string)( $json['base_row_total'] ?? null);
        $result->baseRowTotalInclTax = (string)( $json['base_row_total_incl_tax'] ?? null);
        $result->baseTaxAmount = (string)( $json['base_tax_amount'] ?? null);
        $result->baseTaxBeforeDiscount = (string)( $json['base_tax_before_discount'] ?? null);
        $result->baseTaxInvoiced = (string)( $json['base_tax_invoiced'] ?? null);
        $result->baseTaxRefunded = (string)( $json['base_tax_refunded'] ?? null);
        $result->baseWeeeTaxAppliedAmount = (string)( $json['base_weee_tax_applied_amount'] ?? null);
        $result->baseWeeeTaxAppliedRowAmnt = (string)( $json['base_weee_tax_applied_row_amnt'] ?? null);
        $result->baseWeeeTaxDisposition = (string)( $json['base_weee_tax_disposition'] ?? null);
        $result->baseWeeeTaxRowDisposition = (string)( $json['base_weee_tax_row_disposition'] ?? null);
        $result->createdAt = (string)( $json['created_at'] ?? null);
        $result->description = (string)( $json['description'] ?? null);
        $result->discountAmount =(string)(  $json['discount_amount'] ?? null);
        $result->discountInvoiced = (string)( $json['discount_invoiced'] ?? null);
        $result->discountPercent =(string)(  $json['discount_percent'] ?? null);
        $result->discountRefunded = (string)( $json['discount_refunded'] ?? null);
        $result->eventId = (int) $json['event_id'] ?? null;
        $result->extOrderItemId = (string)( $json['ext_order_item_id'] ?? null);
        $result->freeShipping = $json['free_shipping'] ?? null;
        $result->gwBasePrice = (string)( $json['gw_base_price'] ?? null);
        $result->gwBasePriceInvoiced = (string)( $json['gw_base_price_invoiced'] ?? null);
        $result->gwBasePriceRefunded = (string)( $json['gw_base_price_refunded'] ?? null);
        $result->gwBaseTaxAmount = (string)( $json['gw_base_tax_amount'] ?? null);
        $result->gwBaseTaxAmountInvoiced = (string)( $json['gw_base_tax_amount_invoiced'] ?? null);
        $result->gwBaseTaxAmountRefunded = (string)( $json['gw_base_tax_amount_refunded'] ?? null);
        $result->gwId = $json['gw_id'] ?? null;
        $result->gwPrice = (string)( $json['gw_price'] ?? null);
        $result->gwPriceInvoiced = (string)( $json['gw_price_invoiced'] ?? null);
        $result->gwPriceRefunded = (string)( $json['gw_price_refunded'] ?? null);
        $result->gwTaxAmount = (string)( $json['gw_tax_amount'] ?? null);
        $result->gwTaxAmountInvoiced = (string)( $json['gw_tax_amount_invoiced'] ?? null);
        $result->gwTaxAmountRefunded = (string)( $json['gw_tax_amount_refunded'] ?? null);
        $result->discountTaxCompensationAmount = (string)( $json['discount_tax_compensation_amount'] ?? null);
        $result->discountTaxCompensationCanceled = (string)( $json['discount_tax_compensation_canceled'] ?? null);
        $result->discountTaxCompensationInvoiced = (string)( $json['discount_tax_compensation_invoiced'] ?? null);
        $result->discountTaxCompensationRefunded = (string)( $json['discount_tax_compensation_refunded'] ?? null);
        $result->isQtyDecimal = $json['is_qty_decimal'] ?? null;
        $result->isVirtual = $json['is_virtual'] ?? null;
        $result->itemId = $json['item_id'] ?? null;
        $result->lockedDoInvoice = $json['locked_do_invoice'] ?? null;
        $result->lockedDoShip = $json['locked_do_ship'] ?? null;
        $result->name = (string)( $json['name'] ?? null);
        $result->noDiscount = $json['no_discount'] ?? null;
        $result->orderId = $json['order_id'] ?? null;
        $result->originalPrice = (string)( $json['original_price'] ?? null);
        $result->parentItemId = $json['parent_item_id'] ?? null;
        $result->price =(string)(  $json['price'] ?? null);
        $result->priceInclTax = (string)( $json['price_incl_tax'] ?? null);
        $result->productId = $json['product_id'] ?? null;
        $result->productType = (string)( $json['product_type'] ?? null);
        $result->qtyBackordered = (string)( $json['qty_backordered'] ?? null);
        $result->qtyCanceled = (string)( $json['qty_canceled'] ?? null);
        $result->qtyInvoiced = (string)( $json['qty_invoiced'] ?? null);
        $result->qtyOrdered = (string)( $json['qty_ordered'] ?? null);
        $result->qtyRefunded = (string)( $json['qty_refunded'] ?? null);
        $result->qtyReturned = (string)( $json['qty_returned'] ?? null);
        $result->qtyShipped = (string)( $json['qty_shipped'] ?? null);
        $result->quoteItemId = $json['quote_item_id'] ?? null;
        $result->rowInvoiced =(string)(  $json['row_invoiced'] ?? null);
        $result->rowTotal = (string)( $json['row_total'] ?? null);
        $result->rowTotalInclTax = (string)( $json['row_total_incl_tax'] ?? null);
        $result->rowWeight = (string)( $json['row_weight'] ?? null);
        $result->storeId = $json['store_id'] ?? null;
        $result->taxAmount = (string)( $json['tax_amount'] ?? null);
        $result->taxBeforeDiscount = (string)( $json['tax_before_discount'] ?? null);
        $result->taxCanceled = (string)( $json['tax_canceled'] ?? null);
        $result->taxInvoiced = (string)( $json['tax_invoiced'] ?? null);
        $result->taxPercent = (string)( $json['tax_percent'] ?? null);
        $result->taxRefunded = (string)( $json['tax_refunded'] ?? null);
        $result->updatedAt = (string)( $json['updated_at'] ?? null);
        $result->weeeTaxApplied = (string)( $json['weee_tax_applied'] ?? null);
        $result->weeeTaxAppliedAmount = (string)( $json['weee_tax_applied_amount'] ?? null);
        $result->weeeTaxAppliedRowAmount = (string)( $json['weee_tax_applied_row_amount'] ?? null);
        $result->weeeTaxDisposition = (string)( $json['weee_tax_disposition'] ?? null);
        $result->weeeTaxRowDisposition = (string)( $json['weee_tax_row_disposition'] ?? null);
        $result->weight = (string)( $json['weight'] ?? null);
        $result->parentItem = !empty($json['parent_item']) ? ItemData::fromJson($json['parent_item']) : null;
        $result->productOption =
            isset($json['product_option']) ? ProductOptionData::fromJson($json['product_option']) : null;
        $result->extensionAttributes = ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? []);
        return $result;
    }

    public function getAdditionalData() : ?string
    {
        return $this->additionalData;
    }

    public function getAmountRefunded() : ?string
    {
        return $this->amountRefunded;
    }

    public function getAppliedRuleIds() : ?string
    {
        return $this->appliedRuleIds;
    }

    public function getBaseAmountRefunded() : ?string
    {
        return $this->baseAmountRefunded;
    }

    public function getBaseCost() : ?string
    {
        return $this->baseCost;
    }

    public function getBaseDiscountAmount() : ?string
    {
        return $this->baseDiscountAmount;
    }

    public function getBaseDiscountInvoiced() : ?string
    {
        return $this->baseDiscountInvoiced;
    }

    public function getBaseDiscountRefunded() : ?string
    {
        return $this->baseDiscountRefunded;
    }

    public function getBaseDiscountTaxCompensationAmount() : ?string
    {
        return $this->baseDiscountTaxCompensationAmount;
    }

    public function getBaseDiscountTaxCompensationInvoiced() : ?string
    {
        return $this->baseDiscountTaxCompensationInvoiced;
    }

    public function getBaseDiscountTaxCompensationRefunded() : ?string
    {
        return $this->baseDiscountTaxCompensationRefunded;
    }

    public function getBaseOriginalPrice() : ?string
    {
        return $this->baseOriginalPrice;
    }

    public function getBasePrice() : ?string
    {
        return $this->basePrice;
    }

    public function getBasePriceInclTax() : ?string
    {
        return $this->basePriceInclTax;
    }

    public function getBaseRowInvoiced() : ?string
    {
        return $this->baseRowInvoiced;
    }

    public function getBaseRowTotal() : ?string
    {
        return $this->baseRowTotal;
    }

    public function getBaseRowTotalInclTax() : ?string
    {
        return $this->baseRowTotalInclTax;
    }

    public function getBaseTaxAmount() : ?string
    {
        return $this->baseTaxAmount;
    }

    public function getBaseTaxBeforeDiscount() : ?string
    {
        return $this->baseTaxBeforeDiscount;
    }

    public function getBaseTaxInvoiced() : ?string
    {
        return $this->baseTaxInvoiced;
    }

    public function getBaseTaxRefunded() : ?string
    {
        return $this->baseTaxRefunded;
    }

    public function getBaseWeeeTaxAppliedAmount() : ?string
    {
        return $this->baseWeeeTaxAppliedAmount;
    }

    public function getBaseWeeeTaxAppliedRowAmnt() : ?string
    {
        return $this->baseWeeeTaxAppliedRowAmnt;
    }

    public function getBaseWeeeTaxDisposition() : ?string
    {
        return $this->baseWeeeTaxDisposition;
    }

    public function getBaseWeeeTaxRowDisposition() : ?string
    {
        return $this->baseWeeeTaxRowDisposition;
    }

    public function getCreatedAt() : ?string
    {
        return $this->createdAt;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function getDiscountAmount() : ?string
    {
        return $this->discountAmount;
    }

    public function getDiscountInvoiced() : ?string
    {
        return $this->discountInvoiced;
    }

    public function getDiscountPercent() : ?string
    {
        return $this->discountPercent;
    }

    public function getDiscountRefunded() : ?string
    {
        return $this->discountRefunded;
    }

    public function getEventId() : ?int
    {
        return $this->eventId;
    }

    public function getExtOrderItemId() : ?string
    {
        return $this->extOrderItemId;
    }

    public function getFreeShipping() : ?int
    {
        return $this->freeShipping;
    }

    public function getGwBasePrice() : ?string
    {
        return $this->gwBasePrice;
    }

    public function getGwBasePriceInvoiced() : ?string
    {
        return $this->gwBasePriceInvoiced;
    }

    public function getGwBasePriceRefunded() : ?string
    {
        return $this->gwBasePriceRefunded;
    }

    public function getGwBaseTaxAmount() : ?string
    {
        return $this->gwBaseTaxAmount;
    }

    public function getGwBaseTaxAmountInvoiced() : ?string
    {
        return $this->gwBaseTaxAmountInvoiced;
    }

    public function getGwBaseTaxAmountRefunded() : ?string
    {
        return $this->gwBaseTaxAmountRefunded;
    }

    public function getGwId() : ?int
    {
        return $this->gwId;
    }

    public function getGwPrice() : ?string
    {
        return $this->gwPrice;
    }

    public function getGwPriceInvoiced() : ?string
    {
        return $this->gwPriceInvoiced;
    }

    public function getGwPriceRefunded() : ?string
    {
        return $this->gwPriceRefunded;
    }

    public function getGwTaxAmount() : ?string
    {
        return $this->gwTaxAmount;
    }

    public function getGwTaxAmountInvoiced() : ?string
    {
        return $this->gwTaxAmountInvoiced;
    }

    public function getGwTaxAmountRefunded() : ?string
    {
        return $this->gwTaxAmountRefunded;
    }

    public function getDiscountTaxCompensationAmount() : ?string
    {
        return $this->discountTaxCompensationAmount;
    }

    public function getDiscountTaxCompensationCanceled() : ?string
    {
        return $this->discountTaxCompensationCanceled;
    }

    public function getDiscountTaxCompensationInvoiced() : ?string
    {
        return $this->discountTaxCompensationInvoiced;
    }

    public function getDiscountTaxCompensationRefunded() : ?string
    {
        return $this->discountTaxCompensationRefunded;
    }

    public function getIsQtyDecimal() : ?int
    {
        return $this->isQtyDecimal;
    }

    public function getIsVirtual() : ?int
    {
        return $this->isVirtual;
    }

    public function getItemId() : ?int
    {
        return $this->itemId;
    }

    public function getLockedDoInvoice() : ?int
    {
        return $this->lockedDoInvoice;
    }

    public function getLockedDoShip() : ?int
    {
        return $this->lockedDoShip;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function getNoDiscount() : ?int
    {
        return $this->noDiscount;
    }

    public function getOrderId() : ?int
    {
        return $this->orderId;
    }

    public function getOriginalPrice() : ?string
    {
        return $this->originalPrice;
    }

    public function getParentItemId() : ?int
    {
        return $this->parentItemId;
    }

    public function getPrice() : ?string
    {
        return $this->price;
    }

    public function getPriceInclTax() : ?string
    {
        return $this->priceInclTax;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function getQtyBackordered() : ?string
    {
        return $this->qtyBackordered;
    }

    public function getQtyCanceled() : ?string
    {
        return $this->qtyCanceled;
    }

    public function getQtyInvoiced() : ?string
    {
        return $this->qtyInvoiced;
    }

    public function getQtyOrdered() : ?string
    {
        return $this->qtyOrdered;
    }

    public function getQtyRefunded() : ?string
    {
        return $this->qtyRefunded;
    }

    public function getQtyReturned() : ?string
    {
        return $this->qtyReturned;
    }

    public function getQtyShipped() : ?string
    {
        return $this->qtyShipped;
    }

    public function getQuoteItemId() : ?int
    {
        return $this->quoteItemId;
    }

    public function getRowInvoiced() : ?string
    {
        return $this->rowInvoiced;
    }

    public function getRowTotal() : ?string
    {
        return $this->rowTotal;
    }

    public function getRowTotalInclTax() : ?string
    {
        return $this->rowTotalInclTax;
    }

    public function getRowWeight() : ?string
    {
        return $this->rowWeight;
    }

    public function getSku() : ?string
    {
        return $this->sku;
    }

    public function getStoreId() : ?int
    {
        return $this->storeId;
    }

    public function getTaxAmount() : ?string
    {
        return $this->taxAmount;
    }

    public function getTaxBeforeDiscount() : ?string
    {
        return $this->taxBeforeDiscount;
    }

    public function getTaxCanceled() : ?string
    {
        return $this->taxCanceled;
    }

    public function getTaxInvoiced() : ?string
    {
        return $this->taxInvoiced;
    }

    public function getTaxPercent() : ?string
    {
        return $this->taxPercent;
    }

    public function getTaxRefunded() : ?string
    {
        return $this->taxRefunded;
    }

    public function getUpdatedAt() : ?string
    {
        return $this->updatedAt;
    }

    public function getWeeeTaxApplied() : ?string
    {
        return $this->weeeTaxApplied;
    }

    public function getWeeeTaxAppliedAmount() : ?string
    {
        return $this->weeeTaxAppliedAmount;
    }

    public function getWeeeTaxAppliedRowAmount() : ?string
    {
        return $this->weeeTaxAppliedRowAmount;
    }

    public function getWeeeTaxDisposition() : ?string
    {
        return $this->weeeTaxDisposition;
    }

    public function getWeeeTaxRowDisposition() : ?string
    {
        return $this->weeeTaxRowDisposition;
    }

    public function getWeight() : ?string
    {
        return $this->weight;
    }

    public function getParentItem() : ?ItemData
    {
        return $this->parentItem;
    }

    public function getProductOption() : ?ProductOptionData
    {
        return $this->productOption;
    }

    public function getExtensionAttributes() : ?ExtensionAttributeSet
    {
        return $this->extensionAttributes;
    }

    public function withAdditionalData(string $additionalData): self
    {
        $result = clone $this;
        $result->additionalData = $additionalData;
        return $result;
    }

    public function withAmountRefunded(string $amountRefunded): self
    {
        $result = clone $this;
        $result->amountRefunded = $amountRefunded;
        return $result;
    }

    public function withAppliedRuleIds(string $appliedRuleIds): self
    {
        $result = clone $this;
        $result->appliedRuleIds = $appliedRuleIds;
        return $result;
    }

    public function withBaseAmountRefunded(string $baseAmountRefunded): self
    {
        $result = clone $this;
        $result->baseAmountRefunded = $baseAmountRefunded;
        return $result;
    }

    public function withBaseCost(string $baseCost): self
    {
        $result = clone $this;
        $result->baseCost = $baseCost;
        return $result;
    }

    public function withBaseDiscountAmount(string $baseDiscountAmount): self
    {
        $result = clone $this;
        $result->baseDiscountAmount = $baseDiscountAmount;
        return $result;
    }

    public function withBaseDiscountInvoiced(string $baseDiscountInvoiced): self
    {
        $result = clone $this;
        $result->baseDiscountInvoiced = $baseDiscountInvoiced;
        return $result;
    }

    public function withBaseDiscountRefunded(string $baseDiscountRefunded): self
    {
        $result = clone $this;
        $result->baseDiscountRefunded = $baseDiscountRefunded;
        return $result;
    }

    public function withBaseDiscountTaxCompensationAmount(string $baseDiscountTaxCompensationAmount): self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationAmount = $baseDiscountTaxCompensationAmount;
        return $result;
    }

    public function withBaseDiscountTaxCompensationInvoiced(string $baseDiscountTaxCompensationInvoiced): self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationInvoiced = $baseDiscountTaxCompensationInvoiced;
        return $result;
    }

    public function withBaseDiscountTaxCompensationRefunded(string $baseDiscountTaxCompensationRefunded): self
    {
        $result = clone $this;
        $result->baseDiscountTaxCompensationRefunded = $baseDiscountTaxCompensationRefunded;
        return $result;
    }

    public function withBaseOriginalPrice(string $baseOriginalPrice): self
    {
        $result = clone $this;
        $result->baseOriginalPrice = $baseOriginalPrice;
        return $result;
    }

    public function withBasePrice(string $basePrice): self
    {
        $result = clone $this;
        $result->basePrice = $basePrice;
        return $result;
    }

    public function withBasePriceInclTax(string $basePriceInclTax): self
    {
        $result = clone $this;
        $result->basePriceInclTax = $basePriceInclTax;
        return $result;
    }

    public function withBaseRowInvoiced(string $baseRowInvoiced): self
    {
        $result = clone $this;
        $result->baseRowInvoiced = $baseRowInvoiced;
        return $result;
    }

    public function withBaseRowTotal(string $baseRowTotal): self
    {
        $result = clone $this;
        $result->baseRowTotal = $baseRowTotal;
        return $result;
    }

    public function withBaseRowTotalInclTax(string $baseRowTotalInclTax): self
    {
        $result = clone $this;
        $result->baseRowTotalInclTax = $baseRowTotalInclTax;
        return $result;
    }

    public function withBaseTaxAmount(string $baseTaxAmount): self
    {
        $result = clone $this;
        $result->baseTaxAmount = $baseTaxAmount;
        return $result;
    }

    public function withBaseTaxBeforeDiscount(string $baseTaxBeforeDiscount): self
    {
        $result = clone $this;
        $result->baseTaxBeforeDiscount = $baseTaxBeforeDiscount;
        return $result;
    }

    public function withBaseTaxInvoiced(string $baseTaxInvoiced): self
    {
        $result = clone $this;
        $result->baseTaxInvoiced = $baseTaxInvoiced;
        return $result;
    }

    public function withBaseTaxRefunded(string $baseTaxRefunded): self
    {
        $result = clone $this;
        $result->baseTaxRefunded = $baseTaxRefunded;
        return $result;
    }

    public function withBaseWeeeTaxAppliedAmount(string $baseWeeTaxAppliedAmount): self
    {
        $result = clone $this;
        $result->baseWeeeTaxAppliedAmount = $baseWeeTaxAppliedAmount;
        return $result;
    }

    public function withBaseWeeeTaxAppliedRowAmnt(string $baseWeeeTaxAppliedRowAmnt): self
    {
        $result = clone $this;
        $result->baseWeeeTaxAppliedRowAmnt = $baseWeeeTaxAppliedRowAmnt;
        return $result;
    }

    public function withBaseWeeeTaxDisposition(string $baseWeeeTaxDisposition): self
    {
        $result = clone $this;
        $result->baseWeeeTaxDisposition = $baseWeeeTaxDisposition;
        return $result;
    }

    public function withBaseWeeeTaxRowDisposition(string $baseWeeTaxDisposition): self
    {
        $result = clone $this;
        $result->baseWeeeTaxRowDisposition = $baseWeeTaxDisposition;
        return $result;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $result = clone $this;
        $result->createdAt = $createdAt;
        return $result;
    }

    public function withDescription(string $description): self
    {
        $result = clone $this;
        $result->description = $description;
        return $result;
    }

    public function withDiscountAmount(string $discountAmount): self
    {
        $result = clone $this;
        $result->discountAmount = $discountAmount;
        return $result;
    }

    public function withDiscountInvoiced(string $discountInvoiced): self
    {
        $result = clone $this;
        $result->discountInvoiced = $discountInvoiced;
        return $result;
    }

    public function withDiscountPercent(string $discountPercent): self
    {
        $result = clone $this;
        $result->discountPercent = $discountPercent;
        return $result;
    }

    public function withDiscountRefunded(string $discountRefunded): self
    {
        $result = clone $this;
        $result->discountRefunded = $discountRefunded;
        return $result;
    }

    public function withEventId(int $eventId): self
    {
        $result = clone $this;
        $result->eventId = $eventId;
        return $result;
    }

    public function withExtOrderItemId(string $extOrderItemId): self
    {
        $result = clone $this;
        $result->extOrderItemId = $extOrderItemId;
        return $result;
    }

    public function withFreeShipping(int $freeShipping): self
    {
        $result = clone $this;
        $result->freeShipping = $freeShipping;
        return $result;
    }

    public function withGwBasePrice(string $gwBasePrice): self
    {
        $result = clone $this;
        $result->gwBasePrice = $gwBasePrice;
        return $result;
    }

    public function withGwBasePriceInvoiced(string $gwBasePriceInvoice): self
    {
        $result = clone $this;
        $result->gwBasePriceInvoiced = $gwBasePriceInvoice;
        return $result;
    }

    public function withGwBasePriceRefunded(string $gwBasePriceRefunded): self
    {
        $result = clone $this;
        $result->gwBasePriceRefunded = $gwBasePriceRefunded;
        return $result;
    }

    public function withGwBaseTaxAmount(string $gwBaseTaxAmount): self
    {
        $result = clone $this;
        $result->gwBaseTaxAmount = $gwBaseTaxAmount;
        return $result;
    }

    public function withGwBaseTaxAmountInvoiced(string $gwBaseTaxAmountInvoiced): self
    {
        $result = clone $this;
        $result->gwBaseTaxAmountInvoiced = $gwBaseTaxAmountInvoiced;
        return $result;
    }

    public function withGwBaseTaxAmountRefunded(string $gwBaseTaxAmountRefunded): self
    {
        $result = clone $this;
        $result->gwBaseTaxAmountRefunded = $gwBaseTaxAmountRefunded;
        return $result;
    }

    public function withGwId(int $gwId): self
    {
        $result = clone $this;
        $result->gwId = $gwId;
        return $result;
    }

    public function withGwPrice(string $gwPrice): self
    {
        $result = clone $this;
        $result->gwPrice = $gwPrice;
        return $result;
    }

    public function withGwPriceInvoiced(string $gwPriceInvoiced): self
    {
        $result = clone $this;
        $result->gwPriceInvoiced = $gwPriceInvoiced;
        return $result;
    }

    public function withGwPriceRefunded(string $gwPriceRefunded): self
    {
        $result = clone $this;
        $result->gwPriceRefunded = $gwPriceRefunded;
        return $result;
    }

    public function withGwTaxAmount(string $gwTaxAmount): self
    {
        $result = clone $this;
        $result->gwTaxAmount = $gwTaxAmount;
        return $result;
    }

    public function withGwTaxAmountInvoiced(string $gwTaxAmountInvoiced): self
    {
        $result = clone $this;
        $result->gwTaxAmountInvoiced = $gwTaxAmountInvoiced;
        return $result;
    }

    public function withGwTaxAmountRefunded(string $gwTaxAmountRefunded): self
    {
        $result = clone $this;
        $result->gwTaxAmountRefunded = $gwTaxAmountRefunded;
        return $result;
    }

    public function withDiscountTaxCompensationAmount(string $discountTaxCompensationAmount): self
    {
        $result = clone $this;
        $result->discountTaxCompensationAmount = $discountTaxCompensationAmount;
        return $result;
    }

    public function withDiscountTaxCompensationCanceled(string $discountTaxCompensationCanceled): self
    {
        $result = clone $this;
        $result->discountTaxCompensationCanceled = $discountTaxCompensationCanceled;
        return $result;
    }

    public function withDiscountTaxCompensationInvoiced(string $discountTaxCompensationInvoiced): self
    {
        $result = clone $this;
        $result->discountTaxCompensationInvoiced = $discountTaxCompensationInvoiced;
        return $result;
    }

    public function withDiscountTaxCompensationRefunded(string $discountTaxCompensationRefunded): self
    {
        $result = clone $this;
        $result->discountTaxCompensationRefunded = $discountTaxCompensationRefunded;
        return $result;
    }

    public function withIsQtyDecimal(int $isQtyDecimal): self
    {
        $result = clone $this;
        $result->isQtyDecimal = $isQtyDecimal;
        return $result;
    }

    public function withIsVirtual(int $isVirtual): self
    {
        $result = clone $this;
        $result->isVirtual = $isVirtual;
        return $result;
    }

    public function withItemId(int $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    public function withLockedDoInvoice(int $lockedDoInvoice): self
    {
        $result = clone $this;
        $result->lockedDoInvoice = $lockedDoInvoice;
        return $result;
    }

    public function withLockedDoShip(int $lockedDoShip): self
    {
        $result = clone $this;
        $result->lockedDoShip = $lockedDoShip;
        return $result;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function withNoDiscount(int $noDiscount): self
    {
        $result = clone $this;
        $result->noDiscount = $noDiscount;
        return $result;
    }

    public function withOrderId(int $orderId): self
    {
        $result = clone $this;
        $result->orderId = $orderId;
        return $result;
    }

    public function withOriginalPrice(string $originalPrice): self
    {
        $result = clone $this;
        $result->originalPrice = $originalPrice;
        return $result;
    }

    public function withParentItemId(int $parentItemId): self
    {
        $result = clone $this;
        $result->parentItemId = $parentItemId;
        return $result;
    }

    public function withPrice(string $price): self
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    public function withPriceInclTax(string $priceInclTax): self
    {
        $result = clone $this;
        $result->priceInclTax = $priceInclTax;
        return $result;
    }

    public function withProductId(int $productId): self
    {
        $result = clone $this;
        $result->productId = $productId;
        return $result;
    }

    public function withProductType(string $productType): self
    {
        $result = clone $this;
        $result->productType = $productType;
        return $result;
    }

    public function withQtyBackordered(string $qtyBackordered): self
    {
        $result = clone $this;
        $result->qtyBackordered = $qtyBackordered;
        return $result;
    }

    public function withQtyCanceled(string $qtyCanceled): self
    {
        $result = clone $this;
        $result->qtyCanceled = $qtyCanceled;
        return $result;
    }

    public function withQtyInvoiced(string $qtyInvoiced): self
    {
        $result = clone $this;
        $result->qtyInvoiced = $qtyInvoiced;
        return $result;
    }

    public function withQtyOrdered(string $qtyOrdered): self
    {
        $result = clone $this;
        $result->qtyOrdered = $qtyOrdered;
        return $result;
    }

    public function withQtyRefunded(string $qtyRefunded): self
    {
        $result = clone $this;
        $result->qtyRefunded = $qtyRefunded;
        return $result;
    }

    public function withQtyReturned(string $qtyReturned): self
    {
        $result = clone $this;
        $result->qtyReturned = $qtyReturned;
        return $result;
    }

    public function withQtyShipped(string $qtyShipped): self
    {
        $result = clone $this;
        $result->qtyShipped = $qtyShipped;
        return $result;
    }

    public function withQuoteItemId(int $quoteItemId): self
    {
        $result = clone $this;
        $result->quoteItemId = $quoteItemId;
        return $result;
    }

    public function withRowInvoiced(string $rowInvoiced): self
    {
        $result = clone $this;
        $result->rowInvoiced = $rowInvoiced;
        return $result;
    }

    public function withRowTotal(string $rowTotal): self
    {
        $result = clone $this;
        $result->rowTotal = $rowTotal;
        return $result;
    }

    public function withRowTotalInclTax(string $rowTotalInclTax): self
    {
        $result = clone $this;
        $result->rowTotalInclTax = $rowTotalInclTax;
        return $result;
    }

    public function withRowWeight(string $rowWeight): self
    {
        $result = clone $this;
        $result->rowWeight = $rowWeight;
        return $result;
    }

    public function withStoreId(int $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function withTaxAmount(string $taxAmount): self
    {
        $result = clone $this;
        $result->taxAmount = $taxAmount;
        return $result;
    }

    public function withTaxBeforeDiscount(string $taxBeforeDiscount): self
    {
        $result = clone $this;
        $result->taxBeforeDiscount = $taxBeforeDiscount;
        return $result;
    }

    public function withTaxCanceled(string $taxCanceled): self
    {
        $result = clone $this;
        $result->taxCanceled = $taxCanceled;
        return $result;
    }

    public function withTaxInvoiced(string $taxInvoiced): self
    {
        $result = clone $this;
        $result->taxInvoiced = $taxInvoiced;
        return $result;
    }

    public function withTaxPercent(string $taxPercent): self
    {
        $result = clone $this;
        $result->taxPercent = $taxPercent;
        return $result;
    }

    public function withTaxRefunded(string $taxRefunded): self
    {
        $result = clone $this;
        $result->taxRefunded = $taxRefunded;
        return $result;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $result = clone $this;
        $result->updatedAt = $updatedAt;
        return $result;
    }

    public function withWeeeTaxApplied(string $weeeTaxApplied): self
    {
        $result = clone $this;
        $result->weeeTaxApplied = $weeeTaxApplied;
        return $result;
    }

    public function withWeeeTaxAppliedAmount(string $weeeTaxAppliedAmount): self
    {
        $result = clone $this;
        $result->weeeTaxAppliedAmount = $weeeTaxAppliedAmount;
        return $result;
    }

    public function withWeeeTaxAppliedRowAmount(string $weeeTaxAppliedRowAmount): self
    {
        $result = clone $this;
        $result->weeeTaxAppliedRowAmount = $weeeTaxAppliedRowAmount;
        return $result;
    }

    public function withWeeeTaxDisposition(string $weeeTaxDisposition): self
    {
        $result = clone $this;
        $result->weeeTaxDisposition = $weeeTaxDisposition;
        return $result;
    }

    public function withWeeeTaxRowDisposition(string $weeeTaxRowDisposition): self
    {
        $result = clone $this;
        $result->weeeTaxRowDisposition = $weeeTaxRowDisposition;
        return $result;
    }

    public function withWeight(string $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    public function withParentItem(self $parentItem): self
    {
        $result = clone $this;
        $result->parentItem = $parentItem;
        return $result;
    }

    public function withProductOption(ProductOptionData $productOption): self
    {
        $result = clone $this;
        $result->productOption = $productOption;
        return $result;
    }

    public function withExtensionAttributes($extensionAttributes): self
    {
        $result = clone $this;
        $result->extensionAttributes = $extensionAttributes;
        return $result;
    }

    public function toJson()
    {
        return [
            'additional_data' => $this->additionalData,
            'amount_refunded' => $this->amountRefunded,
            'applied_rule_ids' => $this->appliedRuleIds,
            'base_amount_refunded' => $this->baseAmountRefunded,
            'base_cost' => $this->baseCost,
            'base_discount_amount' => $this->baseDiscountAmount,
            'base_discount_invoiced' => $this->baseDiscountInvoiced,
            'base_discount_refunded' => $this->baseDiscountRefunded,
            'base_discount_tax_compensation_amount' => $this->baseDiscountTaxCompensationAmount,
            'base_discount_tax_compensation_invoiced' => $this->baseDiscountTaxCompensationInvoiced,
            'base_discount_tax_compensation_refunded' => $this->baseDiscountTaxCompensationRefunded,
            'base_original_price' => $this->baseOriginalPrice,
            'base_price' => $this->basePrice,
            'base_price_incl_tax' => $this->basePriceInclTax,
            'base_row_invoiced' => $this->baseRowInvoiced,
            'base_row_total' => $this->baseRowTotal,
            'base_row_total_incl_tax' => $this->baseRowTotalInclTax,
            'base_tax_amount' => $this->baseTaxAmount,
            'base_tax_before_discount' => $this->baseTaxBeforeDiscount,
            'base_tax_invoiced' => $this->baseTaxInvoiced,
            'base_tax_refunded' => $this->baseTaxRefunded,
            'base_weee_tax_applied_amount' => $this->baseWeeeTaxAppliedAmount,
            'base_weee_tax_applied_row_amnt' => $this->baseWeeeTaxAppliedRowAmnt,
            'base_weee_tax_disposition' => $this->baseWeeeTaxDisposition,
            'base_weee_tax_row_disposition' => $this->baseWeeeTaxRowDisposition,
            'created_at' => $this->createdAt,
            'description' => $this->description,
            'discount_amount' => $this->discountAmount,
            'discount_invoiced' => $this->discountInvoiced,
            'discount_percent' => $this->discountPercent,
            'discount_refunded' => $this->discountRefunded,
            'event_id' => $this->eventId,
            'ext_order_item_id' => $this->extOrderItemId,
            'free_shipping' => $this->freeShipping,
            'gw_base_price' => $this->gwBasePrice,
            'gw_base_price_invoiced' => $this->gwBasePriceInvoiced,
            'gw_base_price_refunded' => $this->gwBasePriceRefunded,
            'gw_base_tax_amount' => $this->gwBaseTaxAmount,
            'gw_base_tax_amount_invoiced' => $this->gwBaseTaxAmountInvoiced,
            'gw_base_tax_amount_refunded' => $this->gwBaseTaxAmountRefunded,
            'gw_id' => $this->gwId,
            'gw_price' => $this->gwPrice,
            'gw_price_invoiced' => $this->gwPriceInvoiced,
            'gw_price_refunded' => $this->gwPriceRefunded,
            'gw_tax_amount' => $this->gwTaxAmount,
            'gw_tax_amount_invoiced' => $this->gwTaxAmountInvoiced,
            'gw_tax_amount_refunded' => $this->gwTaxAmountRefunded,
            'discount_tax_compensation_amount' => $this->discountTaxCompensationAmount,
            'discount_tax_compensation_canceled' => $this->discountTaxCompensationCanceled,
            'discount_tax_compensation_invoiced' => $this->discountTaxCompensationInvoiced,
            'discount_tax_compensation_refunded' => $this->discountTaxCompensationRefunded,
            'is_qty_decimal' => $this->isQtyDecimal,
            'is_virtual' => $this->isVirtual,
            'item_id' => $this->itemId,
            'locked_do_invoice' => $this->lockedDoInvoice,
            'locked_do_ship' => $this->lockedDoShip,
            'name' => $this->name,
            'no_discount' => $this->noDiscount,
            'order_id' => $this->orderId,
            'original_price' => $this->originalPrice,
            'parent_item_id' => $this->parentItemId,
            'price' => $this->price,
            'price_incl_tax' => $this->priceInclTax,
            'product_id' => $this->productId,
            'product_type' => $this->productType,
            'qty_backordered' => $this->qtyBackordered,
            'qty_canceled' => $this->qtyCanceled,
            'qty_invoiced' => $this->qtyInvoiced,
            'qty_ordered' => $this->qtyOrdered,
            'qty_refunded' => $this->qtyRefunded,
            'qty_returned' => $this->qtyReturned,
            'qty_shipped' => $this->qtyShipped,
            'quote_item_id' => $this->quoteItemId,
            'row_invoiced' => $this->rowInvoiced,
            'row_total' => $this->rowTotal,
            'row_total_incl_tax' => $this->rowTotalInclTax,
            'row_weight' => $this->rowWeight,
            'sku' => $this->sku,
            'store_id' => $this->storeId,
            'tax_amount' => $this->taxAmount,
            'tax_before_discount' => $this->taxBeforeDiscount,
            'tax_canceled' => $this->taxCanceled,
            'tax_invoiced' => $this->taxInvoiced,
            'tax_percent' => $this->taxPercent,
            'tax_refunded' => $this->taxRefunded,
            'updated_at' => $this->updatedAt,
            'weee_tax_applied' => $this->weeeTaxApplied,
            'weee_tax_applied_amount' => $this->weeeTaxAppliedAmount,
            'weee_tax_applied_row_amount' => $this->weeeTaxAppliedRowAmount,
            'weee_tax_disposition' => $this->weeeTaxDisposition,
            'weee_tax_row_disposition' => $this->weeeTaxRowDisposition,
            'weight' => $this->weight,
            'parent_item' => $this->parentItem !== null ? $this->parentItem->toJson() : [],
            'product_option' => $this->productOption !== null ? $this->productOption->toJson() : null,
            'extension_attributes' => $this->extensionAttributes->toJson(),
        ];
    }

    private $additionalData;
    private $amountRefunded;
    private $appliedRuleIds;
    private $baseAmountRefunded;
    private $baseCost;
    private $baseDiscountAmount;
    private $baseDiscountInvoiced;
    private $baseDiscountRefunded;
    private $baseDiscountTaxCompensationAmount;
    private $baseDiscountTaxCompensationInvoiced;
    private $baseDiscountTaxCompensationRefunded;
    private $baseOriginalPrice;
    private $basePrice;
    private $basePriceInclTax;
    private $baseRowInvoiced;
    private $baseRowTotal;
    private $baseRowTotalInclTax;
    private $baseTaxAmount;
    private $baseTaxBeforeDiscount;
    private $baseTaxInvoiced;
    private $baseTaxRefunded;
    private $baseWeeeTaxAppliedAmount;
    private $baseWeeeTaxAppliedRowAmnt;
    private $baseWeeeTaxDisposition;
    private $baseWeeeTaxRowDisposition;
    private $createdAt;
    private $description;
    private $discountAmount;
    private $discountInvoiced;
    private $discountPercent;
    private $discountRefunded;
    private $eventId;
    private $extOrderItemId;
    private $freeShipping;
    private $gwBasePrice;
    private $gwBasePriceInvoiced;
    private $gwBasePriceRefunded;
    private $gwBaseTaxAmount;
    private $gwBaseTaxAmountInvoiced;
    private $gwBaseTaxAmountRefunded;
    private $gwId;
    private $gwPrice;
    private $gwPriceInvoiced;
    private $gwPriceRefunded;
    private $gwTaxAmount;
    private $gwTaxAmountInvoiced;
    private $gwTaxAmountRefunded;
    private $discountTaxCompensationAmount;
    private $discountTaxCompensationCanceled;
    private $discountTaxCompensationInvoiced;
    private $discountTaxCompensationRefunded;
    private $isQtyDecimal;
    private $isVirtual;
    private $itemId;
    private $lockedDoInvoice;
    private $lockedDoShip;
    private $name;
    private $noDiscount;
    private $orderId;
    private $originalPrice;
    private $parentItemId;
    private $price;
    private $priceInclTax;
    private $productId;
    private $productType;
    private $qtyBackordered;
    private $qtyCanceled;
    private $qtyInvoiced;
    private $qtyOrdered;
    private $qtyRefunded;
    private $qtyReturned;
    private $qtyShipped;
    private $quoteItemId;
    private $rowInvoiced;
    private $rowTotal;
    private $rowTotalInclTax;
    private $rowWeight;
    private $sku;
    private $storeId;
    private $taxAmount;
    private $taxBeforeDiscount;
    private $taxCanceled;
    private $taxInvoiced;
    private $taxPercent;
    private $taxRefunded;
    private $updatedAt;
    private $weeeTaxApplied;
    private $weeeTaxAppliedAmount;
    private $weeeTaxAppliedRowAmount;
    private $weeeTaxDisposition;
    private $weeeTaxRowDisposition;
    private $weight;
    private $parentItem;
    private $productOption;
    private $extensionAttributes;

    public function equals($other): bool
    {
        return $other instanceof self &&
        $this->additionalData === $other->additionalData &&
        $this->amountRefunded === $other->amountRefunded &&
        $this->appliedRuleIds === $other->appliedRuleIds &&
        $this->baseAmountRefunded === $other->baseAmountRefunded &&
        $this->baseCost === $other->baseCost &&
        $this->baseDiscountAmount === $other->baseDiscountAmount &&
        $this->baseDiscountInvoiced === $other->baseDiscountInvoiced &&
        $this->baseDiscountRefunded === $other->baseDiscountRefunded &&
        $this->baseDiscountTaxCompensationAmount === $other->baseDiscountTaxCompensationAmount &&
        $this->baseDiscountTaxCompensationInvoiced === $other->baseDiscountTaxCompensationInvoiced &&
        $this->baseDiscountTaxCompensationRefunded === $other->baseDiscountTaxCompensationRefunded &&
        $this->baseOriginalPrice === $other->baseOriginalPrice &&
        $this->basePrice === $other->basePrice &&
        $this->basePriceInclTax === $other->basePriceInclTax &&
        $this->baseRowInvoiced === $other->baseRowInvoiced &&
        $this->baseRowTotal === $other->baseRowTotal &&
        $this->baseRowTotalInclTax === $other->baseRowTotalInclTax &&
        $this->baseTaxAmount === $other->baseTaxAmount &&
        $this->baseTaxBeforeDiscount === $other->baseTaxBeforeDiscount &&
        $this->baseTaxInvoiced === $other->baseTaxInvoiced &&
        $this->baseTaxRefunded === $other->baseTaxRefunded &&
        $this->baseWeeeTaxAppliedAmount === $other->baseWeeeTaxAppliedAmount &&
        $this->baseWeeeTaxAppliedRowAmnt === $other->baseWeeeTaxAppliedRowAmnt &&
        $this->baseWeeeTaxDisposition === $other->baseWeeeTaxDisposition &&
        $this->baseWeeeTaxRowDisposition === $other->baseWeeeTaxRowDisposition &&
        $this->createdAt === $other->createdAt &&
        $this->description === $other->description &&
        $this->discountAmount === $other->discountAmount &&
        $this->discountInvoiced === $other->discountInvoiced &&
        $this->discountPercent === $other->discountPercent &&
        $this->discountRefunded === $other->discountRefunded &&
        $this->eventId === $other->eventId &&
        $this->extOrderItemId === $other->extOrderItemId &&
        $this->freeShipping === $other->freeShipping &&
        $this->gwBasePrice === $other->gwBasePrice &&
        $this->gwBasePriceInvoiced === $other->gwBasePriceInvoiced &&
        $this->gwBasePriceRefunded === $other->gwBasePriceRefunded &&
        $this->gwBaseTaxAmount === $other->gwBaseTaxAmount &&
        $this->gwBaseTaxAmountInvoiced === $other->gwBaseTaxAmountInvoiced &&
        $this->gwBaseTaxAmountRefunded === $other->gwBaseTaxAmountRefunded &&
        $this->gwId === $other->gwId &&
        $this->gwPrice === $other->gwPrice &&
        $this->gwPriceInvoiced === $other->gwPriceInvoiced &&
        $this->gwPriceRefunded === $other->gwPriceRefunded &&
        $this->gwTaxAmount === $other->gwTaxAmount &&
        $this->gwTaxAmountInvoiced === $other->gwTaxAmountInvoiced &&
        $this->gwTaxAmountRefunded === $other->gwTaxAmountRefunded &&
        $this->discountTaxCompensationAmount === $other->discountTaxCompensationAmount &&
        $this->discountTaxCompensationCanceled === $other->discountTaxCompensationCanceled &&
        $this->discountTaxCompensationInvoiced === $other->discountTaxCompensationInvoiced &&
        $this->discountTaxCompensationRefunded === $other->discountTaxCompensationRefunded &&
        $this->isQtyDecimal === $other->isQtyDecimal &&
        $this->isVirtual === $other->isVirtual &&
        $this->itemId === $other->itemId &&
        $this->lockedDoInvoice === $other->lockedDoInvoice &&
        $this->lockedDoShip === $other->lockedDoShip &&
        $this->name === $other->name &&
        $this->noDiscount === $other->noDiscount &&
        $this->orderId === $other->orderId &&
        $this->originalPrice === $other->originalPrice &&
        $this->parentItemId === $other->parentItemId &&
        $this->price === $other->price &&
        $this->priceInclTax === $other->priceInclTax &&
        $this->productId === $other->productId &&
        $this->productType === $other->productType &&
        $this->qtyBackordered === $other->qtyBackordered &&
        $this->qtyCanceled === $other->qtyCanceled &&
        $this->qtyInvoiced === $other->qtyInvoiced &&
        $this->qtyOrdered === $other->qtyOrdered &&
        $this->qtyRefunded === $other->qtyRefunded &&
        $this->qtyReturned === $other->qtyReturned &&
        $this->qtyShipped === $other->qtyShipped &&
        $this->quoteItemId === $other->quoteItemId &&
        $this->rowInvoiced === $other->rowInvoiced &&
        $this->rowTotal === $other->rowTotal &&
        $this->rowTotalInclTax === $other->rowTotalInclTax &&
        $this->rowWeight === $other->rowWeight &&
        $this->sku === $other->sku &&
        $this->storeId === $other->storeId &&
        $this->taxAmount === $other->taxAmount &&
        $this->taxBeforeDiscount === $other->taxBeforeDiscount &&
        $this->taxCanceled === $other->taxCanceled &&
        $this->taxInvoiced === $other->taxInvoiced &&
        $this->taxPercent === $other->taxPercent &&
        $this->taxRefunded === $other->taxRefunded &&
        $this->updatedAt === $other->updatedAt &&
        $this->weeeTaxApplied === $other->weeeTaxApplied &&
        $this->weeeTaxAppliedAmount === $other->weeeTaxAppliedAmount &&
        $this->weeeTaxAppliedRowAmount === $other->weeeTaxAppliedRowAmount &&
        $this->weeeTaxDisposition === $other->weeeTaxDisposition &&
        $this->weeeTaxRowDisposition === $other->weeeTaxRowDisposition &&
        $this->weight === $other->weight &&
        $this->parentItem === $other->parentItem &&
        (
            ($this->productOption === null && $other->productOption === null) ||
            (
                $this->productOption !== null &&
                $other->productOption !== null &&
                $this->productOption->equals($other->productOption)
            )
        ) &&
        $this->extensionAttributes->equals($other->extensionAttributes);
    }

    private function __construct(string $sku)
    {
        $this->sku = $sku;
        $this->extensionAttributes = ExtensionAttributeSet::create();
    }
}
