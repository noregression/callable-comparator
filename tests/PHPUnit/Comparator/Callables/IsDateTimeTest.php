<?php

namespace BerryGoudswaard\PHPUnit\Comparator\Callables;

class IsDateTimeTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->callable = new IsDateTime();
    }

    public function succeedsProvider()
    {
        return [
            ['2009-06-15T01:45:30'],
            ['2013-03-29T05:13:35-0500'],
            ['1970-01-01 00:00:00']
        ];
    }

    public function failsProvider()
    {
        return [
            ['invalid datetime'],
            ['0000-00-00 00:00:00'],
            ['2015-02-31 15:13:35+0100']
        ];
    }

    public function testIsinstanceOfBaseCallable()
    {
        $this->assertInstanceOf('BerryGoudswaard\PHPUnit\Comparator\Callables\BaseCallable', $this->callable);
    }

    /**
     * @dataProvider failsProvider
     */
    public function testInvalidValues($dateTime)
    {
        $this->assertFalse($this->callable->isValid($dateTime));
    }

    /**
     * @dataProvider succeedsProvider
     */
    public function testValidValues($dateTime)
    {
        $this->assertTrue($this->callable->isValid($dateTime));
    }

    public function testToStringWithValidValue()
    {
        call_user_func($this->callable, '2015-02-04 12:31:34');
        $this->assertEquals('\'2015-02-04 12:31:34\'', (string)$this->callable);
    }

    public function testToStringWithInvalidValue()
    {
        call_user_func($this->callable, 'invalid datetime');
        $this->assertEquals(
            '\'BerryGoudswaard\PHPUnit\Comparator\Callables\IsDateTime error\'',
            (string)$this->callable
        );
    }
}
