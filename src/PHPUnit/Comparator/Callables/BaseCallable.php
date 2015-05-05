<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

abstract class BaseCallable implements CallableInterface
{
    protected $actual;
    protected $isValid;

    public function __invoke($actual)
    {
        $this->actual = $actual;
        return $this->isValid = $this->isValid($actual);
    }

    public function __toString()
    {
        if ($this->isValid) {
            return sprintf('\'%s\'', $this->actual);
        }

        return sprintf('\'%s error\'', get_class($this));
    }
}
