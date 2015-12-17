<?php

namespace NoRegression\PHPUnit\Comparator;

class ArrayComparatorTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->comparator = new ArrayComparator();
    }

    public function testCustomExporterIsUsed()
    {
        $this->assertInstanceOf(
            'NoRegression\PHPUnit\Exporter\Exporter',
            \PHPUnit_Framework_Assert::readAttribute($this->comparator, 'exporter')
        );
    }
}
