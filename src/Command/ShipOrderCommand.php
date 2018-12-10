<?php

namespace SnowIO\Magento2DataModel\Command;

use SnowIO\Magento2DataModel\ShipmentData;

class ShipOrderCommand extends Command
{
    public static function of(int $orderId, ShipmentData $shipmentData): self
    {
        $command = new self();
        $command->orderId = $orderId;
        $command->shipmentData = $shipmentData;
        return $command
            ->withCommandGroupId("ship_order.order.{$orderId}");
    }

    public function getOrderId(): string
    {
        return $this->orderId;
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
        + ['orderId' => $this->orderId];
    }

    /** @var ShipmentData */
    private $shipmentData;
    private $orderId;

    private function __construct()
    {

    }
}