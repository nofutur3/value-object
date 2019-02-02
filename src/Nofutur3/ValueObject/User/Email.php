<?php

declare(strict_types=1);

namespace Nofutur3\ValueObject\User;

class Email extends Base
{
    /** @var string */
    private $value;

    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email `'.$value.'` is not in valid format');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
