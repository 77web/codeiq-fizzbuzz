<?php


namespace CodeIQ\Tests;

use CodeIQ\FizzBuzzSpecification;

class FizzBuzzSpecificationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $spec = new FizzBuzzSpecification(1);
        $this->assertAttributeInternalType('integer', 'divisor', $spec);
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testIsSpecifiedByWithValidData($a, $b)
    {
        $spec = new FizzBuzzSpecification($a);
        $this->assertTrue($spec->isSatisfiedBy($b));
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testIsSpecifiedByWithInvalidData($a, $b)
    {
        $spec = new FizzBuzzSpecification($a);
        $this->assertFalse($spec->isSatisfiedBy($b));
    }

    public function validDataProvider()
    {
        return array(
            array(3, 3),
            array(3, 6),
        );
    }

    public function invalidDataProvider()
    {
        return array(
            array(3, 2),
            array(3, 4),
            array(3, 5),
        );
    }
}
