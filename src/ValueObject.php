<?php
namespace SnowIO\Magento2DataModel;

interface ValueObject
{
    public function equals($object): bool;
}
