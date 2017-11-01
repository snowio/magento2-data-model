<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

final class DeleteCategoryCommand extends Command
{
    public static function of(string $categoryCode): self
    {
        $deleteCategoryCommand = new self;
        $deleteCategoryCommand->categoryCode = $categoryCode;
        return $deleteCategoryCommand;
    }

    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'categoryCode' => $this->categoryCode,
        ];
    }

    private $categoryCode;

    private function __construct()
    {

    }
}
