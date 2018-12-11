<?php

namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\ShipmentData;

class ShipOrderCommand extends Command
{
    public static function of(int $orderIncrementId, ShipmentData $shipmentData): self
    {
        $command = new self();
        $command->orderIncrementId = $orderIncrementId;
        $command->shipmentData = $shipmentData;
        return $command
            ->withCommandGroupId("ship_order.order.{$orderIncrementId}");
    }

    public function orderIncrementId(): string
    {
        return $this->orderIncrementId;
    }

    public function getShipmentData(): ShipmentData
    {
        return $this->shipmentData;
    }

    public function withShipmentData(ShipmentData $shipmentData): self
    {
        $result = clone $this;
        $result->shipmentData = $shipmentData;
        return $result;
    }

    public function toJson(): array
    {
        return parent::toJson()
        + $this->shipmentData->toJson()
        + ['orderIncrementId' => $this->orderIncrementId];
    }

    /** @var ShipmentData */
    private $shipmentData;
    private $orderIncrementId;

    private function __construct()
    {

    }
}