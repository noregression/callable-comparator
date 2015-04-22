<?php

namespace BerryGoudswaard\PHPUnit\Comparator;

use BerryGoudswaard\PHPUnit\Exporter\Exporter;
use SebastianBergmann\Comparator\ArrayComparator as BaseComparator;

class ArrayComparator extends BaseComparator
{
    public function __construct()
    {
        parent::__construct();
        $this->exporter = new Exporter;
    }
}
