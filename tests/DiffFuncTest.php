<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffFuncTest extends Testcase
{
    public static function provideTestFileNames(): mixed
    {
        return [
            ['expStylish.txt', 'file1.json', 'file2.json', 'stylish'],
            ['expStylish.txt', 'file1.yaml', 'file2.yaml', 'stylish'],
            ['expPlain.txt', 'file1.json', 'file2.json', 'plain'],
            ['expPlain.txt', 'file1.yaml', 'file2.yaml', 'plain'],
            ['expJson.txt', 'file1.json', 'file2.json', 'json'],
            ['expJson.txt', 'file1.yaml', 'file2.yaml', 'json']
        ];
    }

    private function makeFilePath(string $fileName): string
    {
        return __DIR__ . "/fixtures/{$fileName}";
    }

    #[DataProvider('provideTestFileNames')]
    public function testGenDiff(string $expectedOut, string $fileName1, string $fileName2, string $format): void
    {
        $expected = $this->makeFilePath($expectedOut);
        $file1 = $this->makeFilePath($fileName1);
        $file2 = $this->makeFilePath($fileName2);
        $this->assertStringEqualsFile($expected, genDiff($file1, $file2, $format));
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
