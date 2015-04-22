<?php

namespace BerryGoudswaard\PHPUnit\Comparator;

use BerryGoudswaard\PHPUnit\Comparator\Callables\BaseCallable;
use BerryGoudswaard\PHPUnit\Exporter\Exporter;
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
        return $expected instanceof BaseCallable;
    }

    public function assertEquals(
        $expected,
        $actual,
        $delta = 0.0,
        $canonicalize = false,
        $ignoreCase = false,
        array &$processed = array()
    ) {
        $result = $expected($actual);

        if (!$result) {
            throw new \SebastianBergmann\Comparator\ComparisonFailure(
                $expected,
                $actual,
                '',
                '',
                false,
                sprintf(
                    'Failed asserting that %s matches expected %s.',
                    $this->exporter->export($actual),
                    $this->exporter->export($expected)
                )
            );
        }

        return $result;
    }
}
