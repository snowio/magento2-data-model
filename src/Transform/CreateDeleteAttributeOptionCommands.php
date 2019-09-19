<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\Distinct;
use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Magento2DataModel\AttributeOption;
use SnowIO\Magento2DataModel\Command\DeleteAttributeOptionCommand;

final class CreateDeleteAttributeOptionCommands
{
    public static function fromIterables(): Transform
    {
        return Pipeline::of(
            GetDeletedItems::fromIterables(function (AttributeOption $attributeOption) {
                return \implode(' ', [$attributeOption->getAttributeCode(), $attributeOption->getValue()]);
            }),
            self::fromAttributeOptions()
        );
    }

    public static function fromAttributeOptions(): Transform
    {
        return Pipeline::of(
            Distinct::withRepresentativeValueFn(function (AttributeOption $attributeOption) {
                return \implode(' ', [$attributeOption->getAttributeCode(), $attributeOption->getValue()]);
            }),
            MapElements::via(function (AttributeOption $attributeOption) {
                return DeleteAttributeOptionCommand::of($attributeOption->getAttributeCode(), $attributeOption->getValue());
            })
        );
    }
}
