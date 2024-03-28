<?php

namespace src;

use function Functional\sort;
use function Parser\parseFile;
use function Render\printArray;

function genDiff(string $file1, string $file2)
{
    if (!file_exists($file1) || !file_exists($file2)) {
        throw new \Exception('No such file!');
    }

    $fileData1 = get_object_vars(parseFile($file1));
    $fileData2 = get_object_vars(parseFile($file2));
    $mergedKeys = array_unique(array_merge(array_keys($fileData1), array_keys($fileData2)));
    $sortedKeys = sort($mergedKeys, fn($left, $right) => strcmp($left, $right));

    $diffArray = array_map(function ($key) use ($fileData1, $fileData2) {
        if (!array_key_exists($key, $fileData1)) {
            return ['key' => $key, 'val2' => $fileData2[$key], 'flag' => 'add'];
        }
        if (!array_key_exists($key, $fileData2)) {
            return ['key' => $key, 'val1' => $fileData1[$key], 'flag' => 'rem'];
        }
        if ($fileData1[$key] === $fileData2[$key]) {
            return ['key' => $key, 'val1' => $fileData1[$key], 'flag' => 'same'];
        }
        return ['key' => $key, 'val1' => $fileData1[$key], 'val2' => $fileData2[$key], 'flag' => 'mod'];
    }, $sortedKeys);

    return printArray($diffArray);
}
