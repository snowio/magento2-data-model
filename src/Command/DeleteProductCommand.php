<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

final class DeleteProductCommand extends Command
{
    public static function of(string $sku): self
    {
        $deleteProductCommand = new self;
        $deleteProductCommand->sku = $sku;
        return $deleteProductCommand;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->sku === $object->sku
            && parent::equals($object);
    }

    public function toJson(): array
    {
        return parent::toJson() + [
            'sku' => $this->sku,
        ];
    }

    private $sku;

    private function __construct()
    {

    }
}
