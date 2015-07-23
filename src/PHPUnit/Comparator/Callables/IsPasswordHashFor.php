<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

use \SebastianBergmann\Comparator\ComparisonFailure;

class IsPasswordHashFor extends BaseCallable
{
    private $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function isValid($actual)
    {
        $isValid = password_verify($this->payload, $actual);

        if ($isValid) {
            return $this->isValid = true;
        }

        throw new ComparisonFailure(
            (string)$this,
            $actual,
            '',
            '',
            false,
            sprintf('Failed asserting that \'%s\' is a password hash for \'%s\'', $actual, $this->payload)
        );
    }
}
