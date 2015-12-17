<?php

namespace NoRegression\PHPUnit\Comparator\Callables;

class CallableProxyTest extends \PHPUnit_Framework_TestCase
{
    public function testWithAssertContainsIsTrue()
    {
        $callable = new CallableProxy([$this, 'assertContains'], ['lazy fox']);
        $this->assertTrue($callable->isValid('This string contains \'lazy fox\''));
    }

    public function testWithAssertContainsIsTrue2()
    {
        $callable = new CallableProxy([$this, 'assertContains'], ['lazy fox']);
        call_user_func($callable, 'This string contains \'lazy fox\'');
        $this->assertEquals('\'This string contains \'lazy fox\'\'', (string)$callable);
    }

    public function testWithAssertContainsIsFalse()
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            'Failed asserting that \'This string does not contain the expected string\' contains "lazy fox".'
        );
        $callable = new CallableProxy([$this, 'assertContains'], ['lazy fox']);
        call_user_func($callable, 'This string does not contain the expected string');
    }

    public function testWithReturnValueTrue()
    {
        $callable = new CallableProxy(function ($expected, $actual) {
            return strpos($actual, $expected) === 22;
        }, ['lazy fox']);
        call_user_func($callable, 'This string contains \'lazy fox\'');
        $this->assertEquals('\'This string contains \'lazy fox\'\'', (string)$callable);
    }

    public function testWithReturnValueFalse()
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            'Failed asserting that the callable proxy returned true'
        );
        $callable = new CallableProxy(function ($expected, $actual) {
            return strpos($actual, $expected) === 22;
        }, ['lazy fox']);
        call_user_func($callable, 'This string does not contain the expected string');
    }

    public function testWithException()
    {
        $this->setExpectedException(
            '\Exception',
            'Exception is thrown in callable'
        );
        $callable = new CallableProxy(function () {
            throw new \Exception('Exception is thrown in callable');
        });
        call_user_func($callable, 'This string does not contain the expected string');
    }
}
