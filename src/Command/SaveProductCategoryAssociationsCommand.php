<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\CategoryCodeSet;
use SnowIO\Magento2DataModel\ProductCategoryAssociations;

final class SaveProductCategoryAssociationsCommand extends Command
{
    public static function of(ProductCategoryAssociations $data)
    {
        $command = new self;
        $command->data = $data;
        return $command;
    }

    public function getProductSku(): string
    {
        return $this->data->getProductSku();
    }

    public function getCategoryCodes(): CategoryCodeSet
    {
        return $this->data->getCategoryCodes();
    }

    public function getData(): ProductCategoryAssociations
    {
        return $this->data;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->data->equals($object->data)
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + $this->data->toJson();
    }

    /** @var ProductCategoryAssociations */
    private $data;

    private function __construct()
    {

    }
}
