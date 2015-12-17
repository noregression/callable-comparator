<?php

namespace NoRegression\PHPUnit\Comparator\Callables;

use \PHPUnit_Framework_ExpectationFailedException;
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
        try {
            return $this->doAssert($actual);
        } catch (PHPUnit_Framework_ExpectationFailedException $e) {
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

    private function doAssert($actual)
    {
        $params = array_merge($this->params, [$actual]);
        $result = call_user_func_array($this->callable, $params);

        if ($result !== null && $result !== true) {
            throw new PHPUnit_Framework_ExpectationFailedException(
                'Failed asserting that the callable proxy returned true'
            );
        }

        return true;
    }
}
