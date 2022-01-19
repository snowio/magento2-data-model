<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

final class DeleteProductCommand extends Command
{
    public static function of(string $sku): self
    {
        $deleteProductCommand = new self;
        $deleteProductCommand->sku = $sku;
        return $deleteProductCommand
            ->withCommandGroupId("product.$sku")
            ->withShardingKey($sku);
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getStoreCode(): string
    {
        return $this->storeCode;
    }

    public function withStoreCode(string $storeCode): self
    {
        $result = clone $this;
        $result->storeCode = $storeCode;
        return $result;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->sku === $object->sku
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + array_merge([
            'sku' => $this->sku,
        ], ($this->storeCode ?  ['@store' => $this->storeCode] : []));
    }

    private $sku;
    private $storeCode;

    private function __construct()
    {

    }
}
