<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\CustomerData;

final class SaveCustomerCommand extends Command
{
    public static function of(CustomerData $customerData): self
    {
        $command = new self;
        $command->customerData = $customerData;
        return $command;
    }

    public function getCustomerData(): CustomerData
    {
        return $this->customerData;
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->customerData->equals($object->customerData)
            && parent::equals($object);
    }

    public function toJson(): array
    {
        $parentJson = parent::toJson();

        $json = $parentJson + ['customer' => $this->customerData->toJson()];

        if ($this->customerData->getId()) {
           $json += ['customerId' => (int) $this->customerData->getId()];
        }

        return $json;
    }

    /** @var CustomerData */
    private $customerData;

    private function __construct()
    {
    }
}
