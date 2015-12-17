<?php

namespace BerryGoudswaard\PHPUnit\Exporter;

use BerryGoudswaard\PHPUnit\Comparator\Callables\IsUuid;
use BerryGoudswaard\PHPUnit\CallableComparatorTrait;

class ExporterTest extends \PHPUnit_Framework_TestCase
{
    use CallableComparatorTrait;

    protected function setUp()
    {
        $this->exporter = new Exporter();
    }

    protected function tearDown()
    {
        $this->tearDownCallableComparator();
    }

    public function testExtendsBaseExporter()
    {
        $this->assertInstanceOf(
            '\SebastianBergmann\Exporter\Exporter',
            $this->exporter
        );
    }

    public function testShortenedExportWithCallable()
    {
        $callable = new IsUuid();

        $this->assertEquals(
            '\'BerryGoudswaard\PHPUnit\Comparator\Callables\IsUuid error\'',
            $this->exporter->shortenedExport($callable)
        );
    }

    public function testShortenedExportWithString()
    {
        $this->assertEquals(
            '\'justAString\'',
            $this->exporter->shortenedExport('justAString')
        );
    }

    public function testOutputWithArrayComparatorIsGood()
    {
        $this->setupCallableComparator();

        $data = [
            'id' => 'e759d425-17b8-4362-ad93-6f6e15f50aa4',
            'data' => 'test'
        ];

        $expected = [
            'id' => new IsUuid()
        ];

        $this->assertNotEquals($expected, $data);
        $this->assertEquals($expected['id'], $data['id']);
    }

    public function testCorrectOutputWithoutExporter()
    {
        $data = [
            'id' => 'e759d425-17b8-4362-ad93-6f6e15f50aa4',
            'data' => 'test'
        ];

        $expected = [
            'id' => new IsUuid()
        ];

        $this->assertNotEquals($expected, $data);
        $this->assertNotEquals($expected['id'], $data['id']);
        $this->assertContains('BerryGoudswaard\PHPUnit\Comparator\Callables\IsUuid error', (string)$expected['id']);
    }
}
