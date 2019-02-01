<?php

namespace Nofutur3\ValueObject\Address;

use Nofutur3\ValueObject\Base;

class PostalCode extends Base
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
