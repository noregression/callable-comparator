<?php

namespace NoRegression\PHPUnit\Exporter;

use NoRegression\PHPUnit\Comparator\Callables\CallableInterface;
use SebastianBergmann\Exporter\Exporter as BaseExporter;

class Exporter extends BaseExporter
{
    public function shortenedExport($value)
    {
        if ($value instanceof CallableInterface) {
            return (string)$value;
        }

        return parent::shortenedExport($value);
    }
}
