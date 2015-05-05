<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

use \SebastianBergmann\Comparator\ComparisonFailure;

class IsUuid extends BaseCallable
{
    const UUID_REGEX = '/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i';

    public function isValid($actual)
    {
        if ((bool)preg_match(self::UUID_REGEX, $actual)) {
            return $this->isValid = true;
        }

        throw new ComparisonFailure(
            (string)$this,
            $actual,
            '',
            '',
            false,
            sprintf('Failed asserting that \'%s\' is a valid UUID', $actual)
        );
    }
}
