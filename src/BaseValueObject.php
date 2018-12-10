<?php
namespace SnowIO\Magento2DataModel;

abstract class BaseValueObject implements ValueObject
{

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                return $this->getData(
                    $this->underScore(substr($method, 3))
                );
        }

        switch (substr($method, 0, 4)) {
            case 'with':
                return $this->handleWith(
                    $this->underScore(substr($method, 4)),
                    $args
                );
            default :
                $argString = print_r($args, 1);
                $fullName = get_class($this) . "::" . $method . "({$argString})";
                throw new \Exception("Invalid method $fullName");
        }
    }

    public function __get($name)
    {
        return $this->getData($this->underScore($name));
    }


    private function underScore($name)
    {
        return strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
    }

    private function handleWith(string $key, $value)
    {
        $result = clone $this;
        $result->setData($key, $value);
        return $result;
    }

    private function setData(string $key, $value)
    {
        $this->data[$key] = $value[0];
    }

    public abstract static function fromJson(array $json);
    public abstract function toJson() : array;

    protected $data;

    private function getData($key)
    {
        return $this->data[$key] ?? null;
    }

    private function hasData($key)
    {
        return isset($this->data[$key]);
    }

    public static abstract function create();

    public function equals($other) : bool
    {
        if (!($other instanceof self)) return false;

        $result = true;

        foreach ($this->data as $key => $value) {
            if (!$other->hasData($key)) {
                return false;
            }

            if (method_exists($value, 'equals')) {
                $result = $result && $value->equals($other->getData($key));
            } elseif (is_scalar($value)) {
                $result = $result && $value === $other->getData($key);
            } else {
                throw new MagentoDataException(sprintf("Invalid type %s", get_class($value)));
            }
        }

        return $result;
    }

    protected function __construct()
    {
    }
}