<?php
declare(strict_types = 1);
namespace SnowIO\Magento2DataModel\Test\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;
use SnowIO\Magento2DataModel\Order\StatusHistoryData;
use SnowIO\Magento2DataModel\Order\StatusHistoryDataCollection;

class StatusHistoryDataTest extends TestCase
{

    public function testToJson()
    {
        $statusHistory = self::getStatusHistory();

        self::assertEquals(self::getStatusHistoryJson(), $statusHistory->toJson());
    }

    public function testFromJson()
    {
        $statusHistory = StatusHistoryData::fromJson(
            self::getStatusHistoryJson()
        );

        self::assertEquals("string", $statusHistory->getComment());
        self::assertEquals("string", $statusHistory->getCreatedAt());
        self::assertEquals(0, $statusHistory->getEntityId());
        self::assertEquals("string", $statusHistory->getEntityName());
        self::assertEquals(0, $statusHistory->getIsCustomerNotified());
        self::assertEquals(0, $statusHistory->getIsVisibleOnFront());
        self::assertEquals(0, $statusHistory->getParentId());
        self::assertEquals("string", $statusHistory->getStatus());
        self::assertTrue(ExtensionAttributeSet::of([])->equals($statusHistory->getExtensionAttributes()));

        self::assertTrue(self::getStatusHistory()->equals($statusHistory));
    }

    public function testEquals()
    {
        $statusHistory = self::getStatusHistory();
        $otherStatusHistory = self::getStatusHistory();

        self::assertTrue($otherStatusHistory->equals($statusHistory));
        $otherStatusHistory = $otherStatusHistory->withExtensionAttributes(
            ExtensionAttributeSet::of([
                ExtensionAttribute::of('test', 'testVal')
            ])
        );
        self::assertFalse($otherStatusHistory->equals($statusHistory));
        self::assertFalse($statusHistory->equals(StatusHistoryDataCollection::create()));
    }

    public static function getStatusHistoryJson(): array
    {
        return [
            "comment" => "string",
            "created_at" => "string",
            "entity_id" => 0,
            "entity_name" => "string",
            "is_customer_notified" => 0,
            "is_visible_on_front" => 0,
            "parent_id" => 0,
            "status" => "string",
            "extension_attributes" => []
        ];
    }

    public static function getStatusHistory(): StatusHistoryData
    {
        return StatusHistoryData::of(0, "string", 0)
            ->withCreatedAt("string")
            ->withEntityId(0)
            ->withEntityName("string")
            ->withIsVisibleOnFront(0)
            ->withStatus('string');
    }
}
