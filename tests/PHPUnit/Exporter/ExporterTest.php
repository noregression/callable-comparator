<?php

namespace BerryGoudswaard\PHPUnit\Exporter;

use BerryGoudswaard\PHPUnit\Comparator\Callables\IsUuid;

class ExporterTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->exporter = new Exporter();
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
}
