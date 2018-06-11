<?php

namespace SnowIO\Magento2DataModel;

final class RegionData implements ValueObject
{
    private $regionCode;
    private $region;
    private $regionId;

    public static function of(string $regionCode): self
    {
        $region = new self($regionCode);
        return $region;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['region_code']);
        $result->regionId = $json['region_id'];
        $result->region = $json['region'];
        return $result;
    }

    public function toJson(): ?array
    {
        return [
            'region_id' => (int) $this->regionId,
            'region_code' => $this->regionCode,
            'region' => $this->region
        ];
    }

    public function equals($otherRegion): bool
    {
        return $otherRegion instanceof RegionData &&
        ($this->regionCode === $otherRegion->regionCode) &&
        ($this->region === $otherRegion->region) &&
        ($this->regionId === $otherRegion->regionId);
    }

    public function withRegionCode(string $regionCode)
    {
        $result = clone $this;
        $result->regionCode = $regionCode;
        return $result;
    }

    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    public function withRegion(string $region)
    {
        $result = clone $this;
        $result->region = $region;
        return $result;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function withRegionId(int $regionId)
    {
        $result = clone $this;
        $result->regionId = $regionId;
        return $result;
    }

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    private function __construct(string $regionCode)
    {
        $this->regionCode = $regionCode;
    }
}
