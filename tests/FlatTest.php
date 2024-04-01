<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function src\genDiff;

class FlatTest extends Testcase
{
    public function testFlatData(): void
    {
        $expected = "{
    common: {
      + follow: false
        setting1: Value 1
      - setting2: 200
      - setting3: true
      + setting3: null
      + setting4: blah blah
      + setting5: {
            key5: value5
        }
        setting6: {
            doge: {
              - wow: 
              + wow: so much
            }
            key: value
          + ops: vops
        }
    }
    group1: {
      - baz: bas
      + baz: bars
        foo: bar
      - nest: {
            key: value
        }
      + nest: str
    }
  - group2: {
        abc: 12345
        deep: {
            id: 45
        }
    }
  + group3: {
        deep: {
            id: {
                number: 45
            }
        }
        fee: 100500
    }
}";
        $fileJson1 = 'tests/fixtures/file1.json';
        $fileJson2 = 'tests/fixtures/file2.json';
        $fileYaml1 = 'tests/fixtures/file1.yaml';
        $fileYaml2 = 'tests/fixtures/file2.yaml';

        $this->assertEquals($expected, genDiff($fileJson1, $fileJson2));
        $this->assertEquals($expected, genDiff($fileYaml1, $fileYaml2));
    }
}
