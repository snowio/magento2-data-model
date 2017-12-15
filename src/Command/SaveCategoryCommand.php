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
        return $result
            ->withCommandGroupId("category.{$categoryData->getCode()}")
            ->withShardingKey($categoryData->getCode());
    }

    public function getCategoryData(): CategoryData
    {
        return $this->categoryData;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->categoryData->equals($object->categoryData)
            && parent::equals($object);
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
