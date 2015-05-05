<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

use \SebastianBergmann\Comparator\ComparisonFailure;

class IsDateTime extends BaseCallable
{
    public function isValid($actual)
    {
        $parsedDate = date_parse($actual);
        $isValid = (bool)$parsedDate && $parsedDate['error_count'] === 0 && $parsedDate['warning_count'] === 0;

        if ($isValid) {
            return $this->isValid = true;
        }

        throw new ComparisonFailure(
            (string)$this,
            $actual,
            '',
            '',
            false,
            sprintf('Failed asserting that \'%s\' is a valid DateTime', $actual)
        );
    }
}
