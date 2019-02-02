<?php

namespace Nofutur3\ValueObject;

abstract class Base implements Comparable
{
    final public function __set($name, $value)
    {
        throw new \LogicException('Are you trying to break immutability for value object? Shame on you!');
    }

    public function equals(Base $object): bool
    {
        if (get_class($this) !== get_class($object)) {
            return false;
        }

        if ($this->getHashCode() !== $object->getHashCode()) {
            return false;
        }

        return true;
    }

    private function getHashCode(): string
    {
        $class = new \ReflectionClass($this);
        $result = [];
        foreach ($class->getProperties() as $property) {
            $property->setAccessible(true);
            $result[$property->getName()] = $property->getValue($this);
        }

        $encoded = \json_encode($result);

        if (false === $encoded) {
            throw new \ErrorException('Not able to serialize properties, please create issue at https://github.com/nofutur3/value-object');
        }

        return md5($encoded);
    }
}
