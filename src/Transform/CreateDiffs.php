<?php
namespace SnowIO\Magento2DataModel\Transform;

use Joshdifabio\Transform\CoGbkResult;
use Joshdifabio\Transform\CoGroupByKey;
use Joshdifabio\Transform\FluentTransformTrait;
use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\MapElements;
use Joshdifabio\Transform\Pipeline;
use Joshdifabio\Transform\Transform;
use Joshdifabio\Transform\Values;
use Joshdifabio\Transform\WithKeys;

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

        return $pipeline->applyTo([Kv::of('previous', $previous), Kv::of('previous', $current)]);
    }

    use FluentTransformTrait;

    private $getItemKeyFn;

    private function __construct()
    {

    }
}
