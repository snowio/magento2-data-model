<?php
declare(strict_types=1);

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\SetTrait;
use SnowIO\Magento2DataModel\ValueObject;

final class CommentSet implements \IteratorAggregate, ValueObject
{
    use SetTrait;

    public function with(Comment $item): self
    {
        $result = clone $this;
        $result->items[] = $item;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $comment) {
            $result = $result->with(Comment::fromJson($comment));
        }
        return $result;
    }

    public function toJson(): array
    {
        return array_map(function (Comment $comment) {
            return $comment->toJson();
        }, array_values($this->items));
    }

    private static function itemsAreEqual(Comment $comment, Comment $otherComment) : bool
    {
        return $comment->equals($otherComment);
    }
}
