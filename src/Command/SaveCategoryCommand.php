<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\CategoryData;

final class SaveCategoryCommand extends Command
{
    public static function of(CategoryData $categoryData): self
    {
        $result = new self;
        $result->categoryData = $categoryData;
        return $result;
    }

    public function getCategoryData(): CategoryData
    {
        return $this->categoryData;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            '@store' => $this->categoryData->getStoreCode(),
            'category' => $this->categoryData->toJson(),
        ];
    }

    /** @var CategoryData */
    private $categoryData;

    private function __construct()
    {

    }
}
