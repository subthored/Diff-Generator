<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function src\genDiff;

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
        $expected = __DIR__ . '/fixtures/expStylish.txt';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertStringEqualsFile($expected, genDiff($fileJson1, $fileJson2));
        $this->assertStringEqualsFile($expected, genDiff($fileYaml1, $fileYaml2));
    }

    public function testJsonFormat(): void
    {
        $expected = __DIR__ . '/fixtures/expStylish.txt';
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertStringEqualsFile($expected, genDiff($fileJson1, $fileJson2));
        $this->assertStringEqualsFile($expected, genDiff($fileYaml1, $fileYaml2));
    }
}
