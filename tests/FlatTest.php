<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function src\genDiff;

class FlatTest extends Testcase
{
    public function testFlatData(): void
    {
        $expected = "{
- follow: false
host: hexlet.io
- proxy: 123.234.53.22
- timeout: 50
+ timeout: 20
+ verbose: true
}";
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertEquals($expected, genDiff($fileJson1, $fileJson2));
        $this->assertEquals($expected, genDiff($fileYaml1, $fileYaml2));
    }
}
