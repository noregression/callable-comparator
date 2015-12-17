<?php

namespace NoRegression\PHPUnit\Comparator;

use NoRegression\PHPUnit\Comparator\Callables\IsUuid;
use NoRegression\PHPUnit\Comparator\Callables\CallableProxy;

class CallableComparatorTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->comparator = new CallableComparator();
    }

    public function testAcceptsSucceeds()
    {
        $callable = new IsUuid();
        $this->assertTrue($this->comparator->accepts($callable, 'canbeanything'));
    }

    public function testAcceptsFails()
    {
        $callable = new \stdClass();
        $this->assertFalse($this->comparator->accepts($callable, 'canbeanything'));
    }

    public function testAssertEqualsSucceeds()
    {
        $callable = new IsUuid();
        $this->assertTrue($this->comparator->assertEquals($callable, 'a717c448-9424-4714-900a-47d0402313df'));
    }

    public function testAssertEqualsFails()
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            'Failed asserting that \'notanuuid\' is a valid UUID'
        );
        $callable = new IsUuid();
        $this->assertTrue($this->comparator->assertEquals($callable, 'notanuuid'));
    }

    public function testAssertEqualsWithArraySucceeds()
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            'Failed asserting that a string is empty'
        );
        $callable = new CallableProxy([$this, 'assertEmpty']);
        $this->assertTrue($this->comparator->assertEquals($callable, 'notempty'));
    }
}
