<?php
namespace SnowIO\Magento2DataModel;

use Closure;

abstract class BaseValueObject implements ValueObject
{

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $property = lcfirst(substr($method, 3));
                $this->assertPropertyExists($property);
                return $this->getObjectProperty($this, $property);
        }

        switch (substr($method, 0, 4)) {
            case 'with':
                $property = lcfirst(substr($method, 4));
                $this->assertPropertyExists($property);
                return $this->handleWith($property, $args);
        }

        $this->throwInvalidMethodException($method, $args);
    }

    private function assertPropertyExists(string $property)
    {
        if (!in_array($property, $this->getPropertyNames())) {
            throw new MagentoDataException("Property $property is not defined in " . get_class($this));
        }
    }

    private function & getObjectProperty($object, $property)
    {
        $value = &Closure::bind(function & () use ($property) {
            return $this->$property;
        }, $object, $object)->__invoke();
        return $value;
    }

    private function handleWith(string $key, $value)
    {
        $result = clone $this;
        $property = &$this->getObjectProperty($result, $key);
        $property = $value[0];
        return $result;
    }

    private function throwInvalidMethodException($method, $args)
    {
        $argString = print_r($args, 1);
        $fullName = get_class($this) . "::" . $method . "({$argString})";
        throw new MagentoDataException("Invalid method $fullName");
    }

    private function getObjectData()
    {
        return array_merge(...array_map(function ($name) {
            return [$name => $this->getObjectProperty($this, $name)];
        }, $this->getPropertyNames()));
    }

    private function getPropertyNames()
    {
        $reflection = new \ReflectionClass($this);
        $filter = $this->getPropertyFilter();
        $properties = $reflection->getProperties($filter);
        $properties = array_map(function (\ReflectionProperty $property) {
            return $property->getName();
        }, $properties);
        return $properties;
    }

    private function getPropertyFilter()
    {
        return \ReflectionProperty::IS_PUBLIC |
        \ReflectionProperty::IS_PROTECTED |
        \ReflectionProperty::IS_PRIVATE;
    }

    public function __get($name)
    {
        $property = lcfirst(substr($name, 3));
        $this->assertPropertyExists($property);
        return $this->getObjectProperty($this, $property);
    }

    public function equals($other) : bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        $result = true;
        foreach ($this->getObjectData() as $key => $value) {
            if (method_exists($value, 'equals')) {
                $result = $result && $value->equals($this->getObjectProperty($other, $key));
            } elseif (is_scalar($value)) {
                $result = $result && $value === $this->getObjectProperty($other, $key);
            } else {
                throw new MagentoDataException(sprintf("Invalid type %s", get_class($value)));
            }
        }

        return $result;
    }

    abstract public static function fromJson(array $json);
    abstract public function toJson() : array;
    abstract public static function create();

    protected function __construct()
    {
    }
}
