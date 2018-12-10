<?php

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Shipment\Comment;

class CommentTest extends TestCase
{
    public function testJson()
    {
        $comment = Comment::fromJson($this->getCommentJson());
        self::assertEquals($this->getCommentJson(), $comment->toJson());
    }

    public function testAccessors()
    {
        $json = $this->getCommentJson();
        $commentData = Comment::fromJson($json);
        self::assertEquals($json['comment'], $commentData->getComment());
        self::assertEquals($json['is_visible_on_front'], $commentData->getIsVisibleOnFront());
        self::assertTrue(
            $commentData->getExtensionAttributes()
                ->equals(ExtensionAttributeSet::fromJson($json['extension_attributes']))
        );
    }

    public function testEquals()
    {
        $comment = Comment::fromJson($this->getCommentJson());
        $otherComment = Comment::fromJson($this->getCommentJson());
        self::assertTrue($comment->equals($otherComment));
        $otherComment = $otherComment->withExtensionAttributes(
            ExtensionAttributeSet::of([ExtensionAttribute::of('foo', 'bar')])
        );
        self::assertFalse($comment->equals($otherComment));
    }

    public function testWitherToSet()
    {
        $json = $this->getCommentJson();
        $json["extension_attributes"] = ['foo' => 'bar'];
        $commentData = Comment::create()
            ->withComment("string")
            ->withIsVisibleOnFront(0)
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('foo', 'bar')
            ]));
        self::assertTrue($commentData->equals(Comment::fromJson($json)));
    }

    private function getCommentJson()
    {
        return [
            "extension_attributes" => [],
            "comment" => "string",
            "is_visible_on_front" => 0
        ];
    }
}