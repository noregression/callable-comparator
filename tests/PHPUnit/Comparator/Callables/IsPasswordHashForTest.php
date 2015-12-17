<?php

namespace NoRegression\PHPUnit\Comparator\Callables;

class IsPasswordHashForTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (phpversion() < 5.5) {
            return $this->markTestSkipped('test');
        }
        $this->callable = new IsPasswordHashFor('password');
    }

    public function testIsinstanceOfBaseCallable()
    {
        $this->assertInstanceOf('NoRegression\PHPUnit\Comparator\Callables\BaseCallable', $this->callable);
    }

    public function testWithInvalidValue()
    {
        $this->setExpectedException(
            '\SebastianBergmann\Comparator\ComparisonFailure',
            'Failed asserting that \'test\' is a password hash for \'password\''
        );
        $this->assertFalse(call_user_func($this->callable, 'test'));
    }

    public function testWithDefaultAlgo()
    {
        $hash = password_hash('password', PASSWORD_DEFAULT);
        $this->assertTrue($this->callable->isValid($hash));
    }

    public function testWithBcryptAlgo()
    {
        $hash = password_hash('password', PASSWORD_BCRYPT);
        $this->assertTrue($this->callable->isValid($hash));
    }

    public function testToStringWithValidValue()
    {
        $hash = password_hash('password', PASSWORD_BCRYPT);
        call_user_func($this->callable, $hash);
        $this->assertEquals(sprintf('\'%s\'', $hash), (string)$this->callable);
    }
}
