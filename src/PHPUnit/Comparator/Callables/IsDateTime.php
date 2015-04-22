<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

class IsDateTime extends BaseCallable
{
    public function isValid($actual)
    {
        $parsedDate = date_parse($actual);
        return (bool)$parsedDate && $parsedDate['error_count'] === 0 && $parsedDate['warning_count'] === 0;
    }
}
