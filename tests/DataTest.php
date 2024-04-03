<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DataTest extends Testcase
{
    public function testStylishFormat(): void
    {
        $expected = __DIR__ . '/fixtures/expStylish.txt';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertStringEqualsFile($expected, genDiff($fileJson1, $fileJson2));
        $this->assertStringEqualsFile($expected, genDiff($fileYaml1, $fileYaml2));
    }

    public function testPlainFormat(): void
    {
        $expected = __DIR__ . '/fixtures/expPlain.txt';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertStringEqualsFile($expected, genDiff($fileJson1, $fileJson2, 'plain'));
        $this->assertStringEqualsFile($expected, genDiff($fileYaml1, $fileYaml2, 'plain'));
    }

    public function testJsonFormat(): void
    {
        $expected = __DIR__ . '/fixtures/expJson.txt';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertStringEqualsFile($expected, genDiff($fileJson1, $fileJson2, 'json'));
        $this->assertStringEqualsFile($expected, genDiff($fileYaml1, $fileYaml2, 'json'));
    }

    public function testWrongFormat(): void
    {
        $expected = 'Invalid format. Supported is: stylish | plain | json .';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertEquals($expected, genDiff($fileJson1, $fileJson2, 'blahblah'));
        $this->assertEquals($expected, genDiff($fileYaml1, $fileYaml2, 'bluhbluh'));
    }
}
