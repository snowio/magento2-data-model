<?php
declare(strict_types=1);

namespace  SnowIO\Magento2DataModel\Test;

use PHPUnit\Framework\TestCase;
use SnowIO\Magento2DataModel\CategoryData;
use SnowIO\Magento2DataModel\CustomAttribute;
use SnowIO\Magento2DataModel\CustomAttributeSet;
use SnowIO\Magento2DataModel\ExtensionAttribute;
use SnowIO\Magento2DataModel\ExtensionAttributeSet;

class CategoryDataTest extends TestCase
{
    public function testToJson()
    {
        $category = CategoryData::of('mens_tshirts', 'Mens T-Shirts')
            ->withParentCode('T-Shirts');
        self::assertEquals([
            'name' => 'Mens T-Shirts',
            'is_active' => true,
            'custom_attributes' => [],
            'extension_attributes' => [
                'code' => 'mens_tshirts',
                'parent_code' => 'T-Shirts',
            ],
        ], $category->toJson());

        $category = CategoryData::of('mens_tshirts', 'Mens T-Shirts');
        self::assertEquals([
            'name' => 'Mens T-Shirts',
            'is_active' => true,
            'custom_attributes' => [],
            'parent_id' => 1,
            'extension_attributes' => [
                'code' => 'mens_tshirts',
            ],
        ], $category->toJson());
    }

    public function testWithers()
    {
        /** @var CategoryData $category */
        $category = CategoryData::of('mens_tshirts', 'Mens T-Shirts')
            ->withParentCode('t_shirts')
            ->withActive(false)
            ->withStoreCode('default')
            ->withExtensionAttribute(ExtensionAttribute::of('category_attribute_group_code', 'clothes'))
            ->withCustomAttributes(CustomAttributeSet::of([
                CustomAttribute::of('fredhopper_category_id', 'menstshirts')
            ]))
            ->withExtensionAttributes(ExtensionAttributeSet::of([
                ExtensionAttribute::of('attribute_group_id', 1),
                ExtensionAttribute::of('data_class_id', 2),
                ExtensionAttribute::of('category_spec', [
                    'allowed_user_type' => 'guest',
                    'discount_user_type' => 'subscribed',
                ])
            ]))
            ->withName('Mens T-Shirts Half Price');

        self::assertEquals('mens_tshirts', $category->getCode());
        self::assertEquals('Mens T-Shirts Half Price', $category->getName());
        self::assertEquals('t_shirts', $category->getParentCode());
        self::assertEquals('default', $category->getStoreCode());
        self::assertEquals('t_shirts', $category->getParentCode());
        self::assertEquals(false, $category->isActive());
        self::assertTrue(ExtensionAttributeSet::of([
            ExtensionAttribute::of('code', 'mens_tshirts'),
            ExtensionAttribute::of('parent_code', 't_shirts'),
            ExtensionAttribute::of('attribute_group_id', 1),
            ExtensionAttribute::of('data_class_id', 2),
            ExtensionAttribute::of('category_spec', [
                'allowed_user_type' => 'guest',
                'discount_user_type' => 'subscribed',
            ]),
        ])->equals($category->getExtensionAttributes()));
        self::assertTrue($category->getCustomAttributes()->equals(CustomAttributeSet::of([
            CustomAttribute::of('fredhopper_category_id', 'menstshirts')
        ])));
    }

    public function testEquals()
    {
        $category = CategoryData::of('mens_tshirts', 'Mens T-Shirts')
            ->withParentCode('T-Shirts');
        self::assertTrue($category->equals(CategoryData::of('mens_tshirts', 'Mens T-Shirts')
            ->withParentCode('T-Shirts')));
        self::assertFalse($category->equals(CategoryData::of('mens_shirts', 'Mens Shirts')
            ->withParentCode('Shirts')));
        self::assertFalse($category->equals(CustomAttribute::of('mens_tshirts', 'shirts')));
    }
}
