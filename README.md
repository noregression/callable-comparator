# PHPUnit Callable Comparator

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.txt)
[![Build Status](https://travis-ci.org/berrygoudswaard/callable-comparator.svg?branch=master)](https://travis-ci.org/berrygoudswaard/callable-comparator)
[![Code Climate](https://codeclimate.com/github/berrygoudswaard/callable-comparator/badges/gpa.svg)](https://codeclimate.com/github/berrygoudswaard/callable-comparator)
[![Test Coverage](https://codeclimate.com/github/berrygoudswaard/callable-comparator/badges/coverage.svg)](https://codeclimate.com/github/berrygoudswaard/callable-comparator)
[![Total Downloads](https://img.shields.io/packagist/dt/berrygoudswaard/callable-comparator.svg)](https://packagist.org/packages/berrygoudswaard/callable-comparator)

Makes it possible to use callables in PHPunit assertions

## Installation
```sh
composer require berrygoudswaard/callable-comparator
```

## Usage
```php
<?php

require_once ('vendor/autoload.php');

use BerryGoudswaard\PHPUnit\Comparator\ArrayComparator;
use BerryGoudswaard\PHPUnit\Comparator\CallableComparator;
use BerryGoudswaard\PHPUnit\Comparator\Callables\IsDateTime;
use BerryGoudswaard\PHPUnit\Comparator\Callables\IsUuid;
use SebastianBergmann\Comparator\Factory;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $comparatorFactory = Factory::getInstance();
        $comparatorFactory->register(new ArrayComparator());
        $comparatorFactory->register(new CallableComparator());
    }

    public function testCallableComparator()
    {
        $data = [
            'id' => 'f4a2b7b0-e944-11e4-b571-0800200c9a66',
            'modified' => '2015-03-22 01:12',
            'emptystring' => '',
            'contains' => 'This string contains "lazy fox".'
        ];

        $expected = [
            'id' => new IsUuid(),
            'modified' => new IsDateTime(),
            'emptystring' => new CallableProxy([$this, 'assertEmpty']),
            'contains' => new CallableProxy([$this, 'assertContains'], ['lazy fox'])
        ];

        $this->assertEquals($expected, $data);
    }
}
```
