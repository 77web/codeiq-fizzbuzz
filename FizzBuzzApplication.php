<?php

namespace CodeIQ;

class FizzBuzzApplication
{
    /**
     * @var array
     */
    private $specs;

    /**
     * @var array
     */
    private $messages;

    public function __construct()
    {
        $this->specs = array();
        $this->messages = array();
    }

    /**
     * @param FizzBuzzSpecification $spec
     * @param string $message
     */
    public function addSpecAndMessage(FizzBuzzSpecification $spec, $message)
    {
        $this->specs[] = $spec;
        $this->messages[] = $message;
    }

    /**
     * @param array $data
     */
    public function run(array $data)
    {
        foreach ($data as $dividend)
        {
            echo $this->getValue($dividend)."\n";
        }
    }

    /**
     * @param int $dividend
     * @return mixed
     */
    private function getValue($dividend)
    {
        foreach ($this->specs as $key => $spec)
        {
            if ($spec->isSatisfiedBy($dividend))
            {
                return $this->messages[$key];
            }
        }

        return $dividend;
    }
}