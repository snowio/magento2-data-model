<?php
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\Inventory\SourceItemDataSet;

class DeleteSourceItemsCommand extends Command
{
    public static function of(SourceItemDataSet $sourceItems): self
    {
        $result = new self;
        $result->sourceItems = $sourceItems;
        return $result;
    }

    public function getSourceItems(): SourceItemDataSet
    {
        return $this->sourceItems;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            "sourceItems" => $this->sourceItems->toJson()
        ];
    }

    /** @var SourceItemDataSet */
    private $sourceItems;

    private function __construct()
    {
    }
}