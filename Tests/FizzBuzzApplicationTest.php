<?php


namespace CodeIQ\Tests;

use CodeIQ\FizzBuzzApplication;
use CodeIQ\FizzBuzzSpecification;

class FizzBuzzApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testAddSpecAndMessage()
    {
        $spec = new FizzBuzzSpecification(1);
        $message = 'Test message';

        $app = new FizzBuzzApplication();
        $app->addSpecAndMessage($spec, $message);
        $this->assertAttributeContains($spec, 'specs', $app);
        $this->assertAttributeContains($message, 'messages', $app);
    }

    public function testRun()
    {
        $message = 'test';

        $spec = $this->getMockBuilder('CodeIQ\FizzBuzzSpecification')
            ->disableOriginalConstructor()
            ->getMock();
        $spec
            ->expects($this->any())
            ->method('isSatisfiedBy')
            ->with($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT))
            ->will($this->returnValue(false))
        ;

        $app = new FizzBuzzApplication();
        $app->addSpecAndMessage($spec, $message);
        ob_start();
        $app->run(array(1, 2));
        $output = ob_get_clean();
        $this->assertEquals("1\n2\n", $output);

        $spec2 = $this->getMockBuilder('CodeIQ\FizzBuzzSpecification')
            ->disableOriginalConstructor()
            ->getMock();
        $spec2
            ->expects($this->any())
            ->method('isSatisfiedBy')
            ->with($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT))
            ->will($this->returnValue(true))
        ;
        $app2 = new FizzBuzzApplication();
        $app2->addSpecAndMessage($spec2, $message);
        ob_start();
        $app2->run(array(1, 2));
        $output2 = ob_get_clean();
        $this->assertEquals("test\ntest\n", $output2);

        $spec3 = $this->getMockBuilder('CodeIQ\FizzBuzzSpecification')
            ->disableOriginalConstructor()
            ->getMock();
        $spec3
            ->expects($this->any())
            ->method('isSatisfiedBy')
            ->with($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT))
            ->will($this->onConsecutiveCalls(array(true, false, false)))
        ;
        $spec4 = $this->getMockBuilder('CodeIQ\FizzBuzzSpecification')
            ->disableOriginalConstructor()
            ->getMock();
        $spec4
            ->expects($this->any())
            ->method('isSatisfiedBy')
            ->with($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT))
            ->will($this->onConsecutiveCalls(array(false, true, false)))
        ;
        $app3 = new FizzBuzzApplication();
        $app3->addSpecAndMessage($spec3, 'test');
        $app3->addSpecAndMessage($spec4, 'test2');
        ob_start();
        $app3->run(array(1, 2, 3));
        $output3 = ob_get_clean();
        $this->assertEquals("test\ntest2\n3\n", $output3);
    }
}
