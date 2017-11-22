<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\CategoryCodeSet;

final class SaveProductCategoryAssociationCommand extends Command
{
    public static function of(string $productSku, CategoryCodeSet $categoryCodes)
    {
        $command = new self;
        $command->productSku = $productSku;
        $command->categoryCodes = $categoryCodes;
        return $command;
    }

    public function getProductSku(): string
    {
        return $this->productSku;
    }

    public function getCategoryCodes(): CategoryCodeSet
    {
        return $this->categoryCodes;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'productSku' => $this->productSku,
            'categoryCodes' => $this->categoryCodes->toArray(),
        ];
    }

    private $productSku;
    /** @var CategoryCodeSet */
    private $categoryCodes;

    private function __construct()
    {

    }
}
