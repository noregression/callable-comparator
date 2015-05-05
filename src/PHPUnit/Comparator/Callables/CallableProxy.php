<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

use \SebastianBergmann\Comparator\ComparisonFailure;

class CallableProxy extends BaseCallable
{
    protected $exception;

    public function __construct(callable $callable, $params = [])
    {
        $this->callable = $callable;
        $this->params = $params;
    }

    public function isValid($actual)
    {
        $params = array_merge($this->params, [$actual]);

        try {
            call_user_func_array($this->callable, $params);
            return true;
        } catch (\Exception $e) {
            throw new ComparisonFailure(
                (string)$this,
                $actual,
                '',
                '',
                false,
                $e->getMessage()
            );
        }
    }
}
