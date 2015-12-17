<?php

namespace NoRegression\PHPUnit\Comparator;

use NoRegression\PHPUnit\Comparator\Callables\CallableInterface;
use NoRegression\PHPUnit\Exporter\Exporter;
use SebastianBergmann\Comparator\Comparator;

class CallableComparator extends Comparator
{
    public function __construct()
    {
        parent::__construct();
        $this->exporter = new Exporter;
    }

    public function accepts($expected, $actual)
    {
        return $expected instanceof CallableInterface;
    }

    public function assertEquals(
        $expected,
        $actual,
        $delta = 0.0,
        $canonicalize = false,
        $ignoreCase = false,
        array &$processed = array()
    ) {
        return call_user_func($expected, $actual);
    }
}
