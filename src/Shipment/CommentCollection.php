<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\Collection;

final class CommentCollection extends Collection
{

    public function with(Comment $comment): self
    {
        $result = clone $this;
        $result->items[] = $comment;
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $result = self::create();
        foreach ($json as $item) {
            $result->items[] = Comment::fromJson($item);
        }
        return $result;
    }

    public function toJson(): array
    {
        return \array_values(\array_map(function (Comment $item) {
            return $item->toJson();
        }, $this->items));
    }

    protected function isEqual($item, $otherItemData): bool
    {
        return $item instanceof Comment
            && $otherItemData instanceof Comment
            && $item->equals($otherItemData);
    }
}
