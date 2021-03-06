<?php
namespace SnowIO\Magento2DataModel\Transform;

use SnowIO\Transform\CoGbkResult;
use SnowIO\Transform\CoGroupByKey;
use SnowIO\Transform\FluentTransformTrait;
use SnowIO\Transform\Kv;
use SnowIO\Transform\MapElements;
use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Transform;
use SnowIO\Transform\Values;
use SnowIO\Transform\WithKeys;

final class CreateDiffs implements Transform
{
    public static function fromIterables(callable $getItemKeyFn): Transform
    {
        $transform = new self;
        $transform->getItemKeyFn = $getItemKeyFn;
        return $transform;
    }

    public function applyTo($input): \Iterator
    {
        $previous = [];
        $current = [];

        /** @var Kv $kv */
        foreach ($input as $kv) {
            switch ($kv->getKey()) {
                case 'previous':
                    $previous = WithKeys::of($this->getItemKeyFn)->applyTo($kv->getValue());
                    break;
                case 'current':
                    $current = WithKeys::of($this->getItemKeyFn)->applyTo($kv->getValue());
                    break;
                default:
                    throw new \Exception;
            }
        }

        $pipeline = Pipeline::of(
            CoGroupByKey::create(),
            Values::get(),
            MapElements::via(function (CoGbkResult $result) {
                return Diff::of($result->getOptional('previous'), $result->getOptional('current'));
            })
        );

        return $pipeline->applyTo([Kv::of('previous', $previous), Kv::of('current', $current)]);
    }

    use FluentTransformTrait;

    private $getItemKeyFn;

    private function __construct()
    {

    }
}
