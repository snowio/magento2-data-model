<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\ProductLinkAssociation;

final class SaveProductLinkAssociationCommand extends Command
{
    public static function of(ProductLinkAssociation $data)
    {
        $command = new self;
        $command->data = $data;
        return $command
            ->withCommandGroupId("product.product_links.{$data->getLinkType()}.{$data->getProductSku()}")
            ->withShardingKey($data->getProductSku());
    }

    public function getProductSku(): string
    {
        return $this->data->getProductSku();
    }

    public function getData(): ProductLinkAssociation
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

    /** @var ProductLinkAssociation */
    private $data;

    private function __construct()
    {
    }
}
