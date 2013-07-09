<?php

namespace CodeIQ;

class FizzBuzzSpecification
{
    /**
     * @var int
     */
    private $divisor;

    /**
     * @param int $divisor
     */
    public function __construct($divisor)
    {
        $this->divisor = $divisor;
    }

    /**
     * @param int $dividend
     * @return bool
     */
    public function isSatisfiedBy($dividend)
    {
        return 0 === $dividend % $this->divisor;
    }
}