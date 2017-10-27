<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\Category;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;

class CategoryTest extends TestCase
{
    public function testToJson()
    {
        $category = Category::of('mens_tshirts', 'Mens T-Shirts')
            ->withParent('T-Shirts');
        self::assertEquals([
            'name' => 'Mens T-Shirts',
            'is_active' => true,
            'custom_attributes' => [],
            'extension_attributes' => [
                'code' => 'mens_tshirts',
                'parent_code' => 'T-Shirts',
            ],
        ],$category->toJson());
    }

    public function testWithers()
    {
        $category = Category::of('mens_tshirts', 'Mens T-Shirts')
            ->withParent('t_shirts')
            ->withActive(false)
            ->withCustomAttributes(CustomAttributeSet::of([
                CustomAttribute::of('fredhopper_category_id', 'menstshirts')
            ]))
            ->withName('Mens T-Shirts Half Price');

        self::assertEquals('mens_tshirts', $category->getCode());
        self::assertEquals('Mens T-Shirts Half Price', $category->getName());
        self::assertEquals('t_shirts', $category->getParentCode());
        self::assertEquals('t_shirts', $category->getParentCode());
        self::assertTrue($category->getCustomAttributes()->equals(CustomAttributeSet::of([
            CustomAttribute::of('fredhopper_category_id', 'menstshirts')
        ])));
    }

    public function testEquals()
    {
        $category = Category::of('mens_tshirts', 'Mens T-Shirts')
            ->withParent('T-Shirts');
        self::assertTrue($category->equals(Category::of('mens_tshirts', 'Mens T-Shirts')
            ->withParent('T-Shirts')));
        self::assertFalse($category->equals(Category::of('mens_shirts', 'Mens Shirts')
            ->withParent('Shirts')));
        self::assertFalse($category->equals(CustomAttribute::of('mens_tshirts', 'shirts')));
    }

}