<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\ProductCategoryAssociation;

final class SaveProductCategoryAssociationCommand extends Command
{
    public static function of(ProductCategoryAssociation $productCategoryAssociation)
    {
        return new self($productCategoryAssociation);
    }

    public function getProductCategoryAssociation(): ProductCategoryAssociation
    {
        return $this->productCategoryAssociation;
    }

    public function toJson(): array
    {
        return parent::toJson() + $this->productCategoryAssociation->toJson();
    }

    private $productCategoryAssociation;

    private function __construct(ProductCategoryAssociation $productCategoryAssociation)
    {
        $this->productCategoryAssociation = $productCategoryAssociation;
    }
}
