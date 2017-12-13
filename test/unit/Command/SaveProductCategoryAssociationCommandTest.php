<?php
declare(strict_types=1);
namespace SnowIO\Magento2DataModel\Test;


use SnowIO\Magento2DataModel\Command\SaveProductCategoryAssociationsCommand;
use SnowIO\Magento2DataModel\CategoryCodeSet;
use SnowIO\Magento2DataModel\ProductCategoryAssociations;

class SaveProductCategoryAssociationCommandTest extends CommandTest
{

    public function testToJson()
    {
        $time = time();
        $associations = ProductCategoryAssociations::of('test-product', CategoryCodeSet::of(['category1']));
        $command = SaveProductCategoryAssociationsCommand::of($associations)
            ->withTimestamp($time);
        self::assertEquals([
            'productSku' => 'test-product',
            'categoryCodes' => ['category1'],
            '@timestamp' => $time,
        ], $command->toJson());
    }

    public function testAccessors()
    {
        $associations = ProductCategoryAssociations::of('test-product', CategoryCodeSet::of(['category1']));
        $command = SaveProductCategoryAssociationsCommand::of($associations);
        self::assertSame('test-product', $command->getProductSku());
        self::assertTrue($command->getCategoryCodes()->equals(CategoryCodeSet::of(['category1'])));
    }
}
