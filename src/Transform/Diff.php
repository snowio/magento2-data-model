<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Magento2DataModel\ValueObject;

final class Diff
{
    const CREATION = 'creation';
    const CHANGE = 'change';
    const NULLOP = 'nullop';
    const DELETION = 'deletion';

    public static function of(?ValueObject $previousData, ?ValueObject $currentData): self
    {
        if ($previousData === null && $currentData === null) {
            throw new \Error;
        }
        $diff = new self;
        $diff->previousData = $previousData;
        $diff->currentData = $currentData;
        return $diff;
    }

    public static function unpack(callable $fn): callable
    {
        return function (Diff $diff) use ($fn) {
            return $fn($diff->getPreviousData(), $diff->getCurrentData());
        };
    }

    public function getPreviousData(): ?ValueObject
    {
        return $this->previousData;
    }

    public function hasPreviousData(): bool
    {
        return $this->previousData === null;
    }

    public function getCurrentData(): ?ValueObject
    {
        return $this->currentData;
    }

    public function hasCurrentData(): bool
    {
        return $this->currentData === null;
    }

    public function getType(): string
    {
        if ($this->previousData === null) {
            return self::CREATION;
        }
        if ($this->currentData === null) {
            return self::DELETION;
        }
        if ($this->currentData->equals($this->previousData)) {
            return self::NULLOP;
        }
        return self::CHANGE;
    }

    /** @var ValueObject|null */
    private $previousData;
    /** @var ValueObject|null */
    private $currentData;

    private function __construct()
    {

    }
}
