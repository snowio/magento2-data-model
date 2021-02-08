<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel;

use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Argument;
use SnowIO\Magento2DataModel\Shipment\CommentCollection;
use SnowIO\Magento2DataModel\Shipment\Item;
use SnowIO\Magento2DataModel\Shipment\ItemCollection;
use SnowIO\Magento2DataModel\Shipment\PackageCollection;
use SnowIO\Magento2DataModel\Shipment\TrackSet;

final class ShipmentData implements ValueObject
{

    /** @var CommentCollection $comments */
    private $comments;
    /** @var ItemCollection $items */
    private $items;
    /** @var PackageCollection */
    private $packages;
    /** @var TrackSet $tracks */
    private $tracks;
    /** @var Argument $arguments */
    private $arguments;
    /** @var boolean $notify */
    private $notify = false;
    /** @var boolean $appendComment */
    private $appendComment = false;

    public static function create(): self
    {
        $result = new self();
        $result->tracks = TrackSet::create();
        $result->packages = PackageCollection::create();
        $result->items = ItemCollection::create();
        $result->comments = CommentCollection::create();
        return $result;
    }

    /**
     * @return CommentCollection
     */
    public function getComments(): CommentCollection
    {
        return $this->comments;
    }

    /**
     * @param CommentCollection $comments
     * @return ShipmentData
     */
    public function withComments(CommentCollection $comments): ShipmentData
    {
        $clone = clone $this;
        $clone->comments = $comments;
        return $clone;
    }

    /**
     * @return ItemCollection
     */
    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    /**
     * @param ItemCollection $items
     * @return ShipmentData
     */
    public function withItems(ItemCollection $items): ShipmentData
    {
        $clone = clone $this;
        $clone->items = $items;
        return $clone;
    }

    /**
     * @return PackageCollection
     */
    public function getPackages(): PackageCollection
    {
        return $this->packages;
    }

    /**
     * @param PackageCollection $packages
     * @return ShipmentData
     */
    public function withPackages(PackageCollection $packages): ShipmentData
    {
        $clone = clone $this;
        $clone->packages = $packages;
        return $clone;
    }

    /**
     * @return TrackSet
     */
    public function getTracks(): TrackSet
    {
        return $this->tracks;
    }

    /**
     * @param TrackSet $tracks
     * @return ShipmentData
     */
    public function withTracks(TrackSet $tracks): ShipmentData
    {
        $clone = clone $this;
        $clone->tracks = $tracks;
        return $clone;
    }

    /**
     * @return Argument
     */
    public function getArguments(): Argument
    {
        return $this->arguments;
    }

    /**
     * @param Argument $arguments
     * @return ShipmentData
     */
    public function withArguments(Argument $arguments): ShipmentData
    {
        $clone = clone $this;
        $clone->arguments = $arguments;
        return $clone;
    }

    /**
     * @return bool
     */
    public function isNotify(): bool
    {
        return $this->notify;
    }

    /**
     * @param bool $notify
     * @return ShipmentData
     */
    public function withNotify(bool $notify): ShipmentData
    {
        $clone = clone $this;
        $clone->notify = $notify;
        return $clone;
    }

    /**
     * @return bool
     */
    public function isAppendComment(): bool
    {
        return $this->appendComment;
    }

    /**
     * @param bool $appendComment
     * @return ShipmentData
     */
    public function withAppendComment(bool $appendComment): ShipmentData
    {
        $clone = clone $this;
        $clone->appendComment = $appendComment;
        return $clone;
    }

    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result->arguments = Argument::fromJson($json['arguments'] ?? []);
        $result->notify = $json['notify'] ?? false;
        $result->appendComment = $json['append_comment'] ?? false;
        $result->comments = CommentCollection::fromJson($json['comments'] ?? []);
        $result->items = ItemCollection::fromJson($json['items']);
        $result->packages = PackageCollection::fromJson($json['packages'] ?? []);
        $result->tracks = TrackSet::fromJson($json['tracks']);
        return $result;
    }

    public function toJson() : array
    {
        return [
            "arguments" => $this->arguments->toJson(),
            "notify" => $this->notify ?? false,
            "append_comment" => $this->appendComment ?? false,
            "comments" => $this->comments->toJson(),
            "items" => $this->items->toJson(),
            "packages" => $this->packages->toJson(),
            "tracks" => $this->tracks->toJson(),
        ];
    }

    public function equals($other): bool
    {
        return $other instanceof $this &&
            $this->arguments->equals($other->arguments) &&
            $this->notify === $other->notify &&
            $this->appendComment === $other->appendComment &&
            $this->comments->equals($other->comments) &&
            $this->items->equals($other->items) &&
            $this->packages->equals($other->packages) &&
            $this->tracks->equals($other->tracks);
    }
}
