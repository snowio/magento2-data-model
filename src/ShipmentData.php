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
    /** @var string|null $orderIncrement */
    private $orderIncrement;
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
    /** @var boolean|null $notify */
    private $notify;
    /** @var boolean|null $appendComment */
    private $appendComment;

    public static function create(): self
    {
        $result = new self();
        $result->arguments = Argument::create();
        $result->tracks = TrackSet::create();
        $result->packages = PackageCollection::create();
        $result->items = ItemCollection::create();
        $result->comments = CommentCollection::create();
        return $result;
    }

    /**
     * @return string|null
     */
    public function getOrderIncrement(): ?string
    {
        return $this->orderIncrement;
    }

    /**
     * @param string|null $orderIncrement
     * @return ShipmentData
     */
    public function withOrderIncrement(?string $orderIncrement): ShipmentData
    {
        $clone = clone $this;
        $clone->orderIncrement = $orderIncrement;
        return $clone;
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
     * @return bool|null
     */
    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    /**
     * @param bool|null $notify
     * @return ShipmentData
     */
    public function withNotify(?bool $notify): ShipmentData
    {
        $clone = clone $this;
        $clone->notify = $notify;
        return $clone;
    }

    /**
     * @return bool|null
     */
    public function getAppendComment(): ?bool
    {
        return $this->appendComment;
    }

    /**
     * @param bool|null $appendComment
     * @return ShipmentData
     */
    public function withAppendComment(?bool $appendComment): ShipmentData
    {
        $clone = clone $this;
        $clone->appendComment = $appendComment;
        return $clone;
    }

    public static function fromJson(array $json): self
    {
        /** @var ShipmentData $result */
        $result = self::create();
        $result->orderIncrement = $json['order_increment_id'] ?? null;
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
        $json = [];

        if ($this->getOrderIncrement()) {
            $json['order_increment_id'] = $this->getOrderIncrement();
        }
        if (!$this->getTracks()->isEmpty()) {
            $json['tracks'] = $this->getTracks()->toJson();
        }
        if (!$this->getArguments()->isEmpty()) {
            $json['arguments'] = $this->getArguments()->toJson();
        }
        if (!$this->getComments()->isEmpty()) {
            $json['comments'] = $this->getComments()->toJson();
        }
        if (!$this->getItems()->isEmpty()) {
            $json['items'] = $this->getItems()->toJson();
        }
        if (!$this->getPackages()->isEmpty()) {
            $json['packages'] = $this->getPackages()->toJson();
        }
        if ($this->getNotify()) {
            $json['notify'] = $this->getNotify();
        }
        if ($this->getAppendComment()) {
            $json['append_comment'] = $this->getAppendComment();
        }

        return $json;
    }

    public function equals($other): bool
    {
        return $other instanceof $this &&
            $this->orderIncrement === $other->getOrderIncrement() &&
            $this->arguments->equals($other->arguments) &&
            $this->notify === $other->notify &&
            $this->appendComment === $other->appendComment &&
            $this->comments->equals($other->comments) &&
            $this->items->equals($other->items) &&
            $this->packages->equals($other->packages) &&
            $this->tracks->equals($other->tracks);
    }
}
