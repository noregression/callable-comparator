<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

class IsUuid extends BaseCallable
{
    const UUID_REGEX = '/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i';

    public function isValid($actual)
    {
        return (bool)preg_match(self::UUID_REGEX, $actual);
    }
}
