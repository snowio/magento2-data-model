<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Command;

abstract class Command
{
    public function getTimestamp(): ?float
    {
        return $this->timestamp;
    }

    public function withTimestamp(float $timestamp)
    {
        $result = clone $this;
        $result->timestamp = $timestamp;
        return $result;
    }

    public function getShardingKey(): ?string
    {
        return $this->shardingKey;
    }

    public function withShardingKey(string $shardingKey)
    {
        $result = clone $this;
        $result->shardingKey = $shardingKey;
        return $result;
    }

    public function getCommandGroupId(): ?string
    {
        return $this->commandGroupId;
    }

    public function withCommandGroupId(string $commandGroupId)
    {
        $result = clone $this;
        $result->commandGroupId = $commandGroupId;
        return $result;
    }

    public function toJson(): array
    {
        $json = [];

        if (isset($this->timestamp)) {
            $json['@timestamp'] = $this->timestamp;
        }

        if (isset($this->shardingKey)) {
            $json['@shardingKey'] = $this->shardingKey;
        }

        if (isset($this->commandGroupId)) {
            $json['@commandGroupId'] = $this->commandGroupId;
        }

        return $json;
    }

    private $timestamp;
    private $commandGroupId;
    private $shardingKey;
}