<?php
namespace SnowIO\Magento2DataModel\Command;

class MoveCategoryCommand extends Command
{
    public static function of(string $categoryCode, ?string $parentCategoryCode): self
    {
        $command = new self;
        $command->categoryCode = $categoryCode;
        $command->parentCategoryCode = $parentCategoryCode;
        return $command
            ->withCommandGroupId("category.$categoryCode")
            ->withShardingKey($categoryCode);
    }

    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    public function getParentCategoryCode(): ?string
    {
        return $this->parentCategoryCode;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->categoryCode === $object->categoryCode
            && $this->parentCategoryCode === $object->parentCategoryCode
            && parent::equals($object);
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

    private function __construct()
    {

    }
}
