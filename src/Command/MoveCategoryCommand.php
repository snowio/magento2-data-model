<?php
namespace SnowIO\Magento2DataModel\Command;

class MoveCategoryCommand extends Command
{
    public static function of(string $categoryCode, string $parentCategoryCode): self
    {
        $command = new self;
        $command->categoryCode = $categoryCode;
        $command->parentCategoryCode = $parentCategoryCode;
        return $command;
    }

    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    public function getParentCategoryCode(): string
    {
        return $this->categoryCode;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'categoryCode' => $this->categoryCode,
            'parentCode' => $this->parentCategoryCode,
        ];
    }

    private $categoryCode;
    private $parentCategoryCode;
}
