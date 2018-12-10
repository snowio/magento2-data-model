<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\Shipment\Arguments;
use SnowIO\Magento2DataModel\Shipment\Comment;
use SnowIO\Magento2DataModel\Shipment\ItemSet;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;
use SnowIO\Magento2DataModel\Shipment\TrackSet;

/**
 * Class ShipmentData
 * @package SnowIO\Magento2DataModel
 * @method ItemSet getItems()
 * @method Comment getComment()
 * @method bool getNotify()
 * @method bool getAppendComment()
 * @method TrackSet getTracks()
 * @method PackageCollection getPackages()
 * @method Arguments getArguments()
 *
 * @method ShipmentData withAppendComment(bool $appendComment)
 * @method ShipmentData withItems(ItemSet $items)
 * @method ShipmentData withComment(Comment $comment)
 * @method ShipmentData withNotify(bool $notify)
 * @method ShipmentData withTracks(TrackSet $tracks)
 * @method ShipmentData withPackages(PackageCollection $packages)
 * @method ShipmentData withArguments(Arguments $packages)
 */
final class ShipmentData extends BaseValueObject
{
    public static function create(): self
    {
        return (new self())
            ->withItems(ItemSet::create())
            ->withTracks(TrackSet::create())
            ->withArguments(Arguments::create())
            ->withPackages(PackageCollection::create());
    }


    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result = isset($json['items'])
            ? $result->withItems(ItemSet::fromJson($json['items'])) : $result;
        $result = isset($json['notify'])
            ? $result->withNotify($json['notify']) : $result;
        $result = isset($json['appendComment'])
            ? $result->withAppendComment($json['appendComment']) : $result;
        $result = isset($json['comment'])
            ? $result->withComment(Comment::fromJson($json['comment'])) : $result;
        $result = isset($json['tracks'])
            ? $result->withTracks(TrackSet::fromJson($json['tracks'])) : $result;
        $result = isset($json['packages'])
            ? $result->withPackages(PackageCollection::fromJson($json['packages'])) : $result;
        $result = isset($json['arguments'])
            ? $result->withArguments(Arguments::fromJson($json['arguments'])) : $result;

        return $result;
    }

    public function toJson() : array
    {
        return [
            "items" => $this->getItems()->toJson(),
            "notify" => $this->getNotify(),
            "appendComment" => $this->getAppendComment(),
            "comment" => $this->getComment() ? $this->getComment()->toJson() : null,
            "tracks" => $this->getTracks()->toJson(),
            "packages" => $this->getPackages()->toJson(),
            "arguments" => $this->getArguments()->toJson(),
        ];
    }
}