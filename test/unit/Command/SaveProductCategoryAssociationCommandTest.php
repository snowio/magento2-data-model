<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;


use SnowIO\Magento2DataModel\Command\SaveProductCategoryAssociationsCommand;
use SnowIO\Magento2DataModel\CategoryCodeSet;

class SaveProductCategoryAssociationCommandTest extends CommandTest
{

    public function testToJson()
    {
        $time = time();
        $command = SaveProductCategoryAssociationsCommand::of('test-product', CategoryCodeSet::of(['category1']))
            ->withTimestamp($time);
        self::assertEquals([
            'productSku' => 'test-product',
            'categoryCodes' => ['category1'],
            '@timestamp' => $time,
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $command = SaveProductCategoryAssociationsCommand::of('test-product', CategoryCodeSet::of(['category1']));
        self::assertSame('test-product', $command->getProductSku());
        self::assertTrue($command->getCategoryCodes()->equals(CategoryCodeSet::of(['category1'])));
    }
}
