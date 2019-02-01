<?php

namespace Nofutur3\ValueObject;

interface Comparable
{
    /**
     * Is is it equal or is it not? That's the question. Will compare the type of object and all the values.
     *
     * @param Base $object
     */
    public function equals(Base $object): bool;
}
