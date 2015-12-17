<?php

namespace BerryGoudswaard\PHPUnit\Exporter;

use BerryGoudswaard\PHPUnit\CallableComparatorTrait;
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

        $this->assertInstanceOf('\BerryGoudswaard\PHPUnit\Comparator\ArrayComparator', $comparator);
    }

    public function testCallableComparator()
    {
        $callableComparatorMock = $this
            ->getMockBuilder('\BerryGoudswaard\PHPUnit\Comparator\Callables\CallableInterface')
            ->getMock();

        $comparatorFactory = Factory::getInstance();
        $comparator = $comparatorFactory->getComparatorFor($callableComparatorMock, null);

        $this->assertInstanceOf('\BerryGoudswaard\PHPUnit\Comparator\CallableComparator', $comparator);
    }
}
