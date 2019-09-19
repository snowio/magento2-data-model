<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test\Transform;

use SnowIO\Transform\Kv;
use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\ProductLinkAssociation;
use SnowIO\Magento2DataModel\Transform\CreateSaveProductLinkCommands;
use SnowIO\Magento2DataModel\ProductLink;

class CreateSaveProductLinkCommandsTest extends TestCase
{
    public function testFromIterables()
    {
        $newItems = new \ArrayIterator([
            ProductLinkAssociation::of(ProductLink::of('a', 'c', 'associated')),
        ]);

        $result = CreateSaveProductLinkCommands::fromIterables()
            ->applyTo([
                Kv::of('current', $newItems),
                Kv::of('previous', [])
            ]);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(\Generator::class, $result);
    }
}