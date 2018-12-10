<?php

namespace SnowIO\Magento2DataModel\Shipment;

use SnowIO\Magento2DataModel\BaseValueObject;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

/**
 * Class Comment
 * @package SnowIO\Magento2DataModel\Shipment
 * @method string getComment()
 * @method int getIsVisibleOnFront()
 * @method ExtensionAttributeSet getExtensionAttributes()
 * @method Comment withComment(string $comment)
 * @method Comment withIsVisibleOnFront(?int $isVisibleOnFront)
 * @method Comment withExtensionAttributes(ExtensionAttributeSet $extensionAttributes)
 */
class Comment extends BaseValueObject
{

    public static function create(): self
    {
        return (new self())
            ->withExtensionAttributes(ExtensionAttributeSet::create());
    }

    public static function fromJson(array $json): self
    {
        return self::create()
            ->withExtensionAttributes(
                ExtensionAttributeSet::fromJson($json['extension_attributes'] ?? [])
            )
            ->withComment($json['comment'])
            ->withIsVisibleOnFront($json['is_visible_on_front'] ?? null);
    }

    public function toJson() : array
    {
        return [
            'extension_attributes' => $this->getExtensionAttributes()->toJson(),
            'is_visible_on_front' => $this->getIsVisibleOnFront(),
            'comment' => $this->getComment()
        ];
    }
}