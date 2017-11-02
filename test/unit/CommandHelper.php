<?php
namespace SnowIO\Magento2DataModel\Test;

use SnowIO\Magento2DataModel\Command\Command;

trait CommandHelper
{
    private function getJson(array $commands): array
    {
        return \array_map(function (Command $command) {
            return $command->toJson();
        }, $commands);
    }
}