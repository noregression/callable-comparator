<?php

namespace NoRegression\PHPUnit\Comparator\Callables;

class IsUuidTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->callable = new IsUuid();
    }

    public function succeedsProvider()
    {
        return [
            ['a717c448-9424-4714-900a-47d0402313df'],
            ['6b50d572-7cc0-4413-b35c-61907f3097a5'],
            ['0b25ade5-6a0a-41b5-8182-84de7f08ef06'],
            ['214e50bc-dbc7-4212-9523-1466014bbc44'],
            ['b12a48d3-5586-4b22-ae86-0bc3839ad79d']
        ];
    }

    public function failsProvider()
    {
        return [
            ['invalid uuid'],
            ['_a717c448-9424-4714-900a-47d0402313df_'],
            ['a717c448-9424_4714-900a-47d0402313df'],
            ['12313a717c448-9424_4714-900a-47d0402313df']
        ];
    }

    public function testIsinstanceOfBaseCallable()
    {
        $this->assertInstanceOf('NoRegression\PHPUnit\Comparator\Callables\BaseCallable', $this->callable);
    }

    /**
     * @dataProvider failsProvider
     */
    public function testInvalidValues($uuid)
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            sprintf('Failed asserting that \'%s\' is a valid UUID', $uuid)
        );
        $this->assertFalse(call_user_func($this->callable, $uuid));
    }

    /**
     * @dataProvider succeedsProvider
     */
    public function testValidValues($uuid)
    {
        $this->assertTrue(call_user_func($this->callable, $uuid));
    }

    public function testToStringWithValidValue()
    {
        call_user_func($this->callable, 'b12a48d3-5586-4b22-ae86-0bc3839ad79d');
        $this->assertEquals('\'b12a48d3-5586-4b22-ae86-0bc3839ad79d\'', (string)$this->callable);
    }
}
