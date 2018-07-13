<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Order\StatusHistoryData;
use SnowIO\Magento2DataModel\Order\StatusHistoryDataCollection;

class StatusHistoryDataCollectionTest extends TestCase
{
    public function testWither()
    {
        $statusHistoryData = StatusHistoryDataCollection::of([
            StatusHistoryData::of("1", 'test', 0),
            StatusHistoryData::of("1", 'test 3', 0),
        ]);

        $statusHistoryData = $statusHistoryData->with(
            StatusHistoryData::of("2", ' test 2', 0)
        );

        self::assertTrue(StatusHistoryDataCollection::of([
            StatusHistoryData::of("1", 'test', 0),
            StatusHistoryData::of("1", 'test 3', 0),
            StatusHistoryData::of("2", ' test 2', 0)
        ])->equals($statusHistoryData));
    }
}
