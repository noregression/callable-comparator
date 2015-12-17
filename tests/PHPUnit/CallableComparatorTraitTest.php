<?php

namespace NoRegression\PHPUnit\Exporter;

use NoRegression\PHPUnit\CallableComparatorTrait;
use SebastianBergmann\Comparator\Factory;

class CallableComparatorTraitTest extends \PHPUnit_Framework_TestCase
{
    use CallableComparatorTrait;

    public function setUp()
    {
        $this->setupCallableComparator();
    }

    public function tearDown()
    {
        $this->tearDownCallableComparator();
    }

    public function testArrayComparator()
    {
        $comparatorFactory = Factory::getInstance();
        $comparator = $comparatorFactory->getComparatorFor([], []);

        $this->assertInstanceOf('\NoRegression\PHPUnit\Comparator\ArrayComparator', $comparator);
    }

    public function testCallableComparator()
    {
        $callableComparatorMock = $this
            ->getMockBuilder('\NoRegression\PHPUnit\Comparator\Callables\CallableInterface')
            ->getMock();

        $comparatorFactory = Factory::getInstance();
        $comparator = $comparatorFactory->getComparatorFor($callableComparatorMock, null);

        $this->assertInstanceOf('\NoRegression\PHPUnit\Comparator\CallableComparator', $comparator);
    }
}
