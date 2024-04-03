<?php

namespace src;

use function Functional\sort;
use function Parser\parseFile;
use function format\format;

function genDiff(string $file1, string $file2, string $formatter = 'stylish'): string
{
    $data1 = parseFile($file1);
    $data2 = parseFile($file2);
    $diffTree = diffTree($data1, $data2);
    // var_dump($formatter);
    return format($diffTree, $formatter);
}

function diffTree(object $data1, object $data2): array
{
    $fileData1 = get_object_vars($data1);
    $fileData2 = get_object_vars($data2);
    $mergedKeys = array_unique(array_merge(array_keys($fileData1), array_keys($fileData2)));
    $sortedKeys = sort($mergedKeys, fn($left, $right) => strcmp($left, $right));

    return array_map(function ($key) use ($fileData1, $fileData2) {
        if (!array_key_exists($key, $fileData1)) {
            return ['key' => $key, 'val2' => $fileData2[$key], 'flag' => 'add'];
        }
        if (!array_key_exists($key, $fileData2)) {
            return ['key' => $key, 'val1' => $fileData1[$key], 'flag' => 'rem'];
        }
        if (is_object($fileData1[$key]) && is_object($fileData2[$key])) {
            $child = diffTree($fileData1[$key], $fileData2[$key]);
            return ['key' => $key, 'flag' => 'parent', 'child' => $child];
        }
        if ($fileData1[$key] === $fileData2[$key]) {
            return ['key' => $key, 'val1' => $fileData1[$key], 'flag' => 'same'];
        }
        return ['key' => $key, 'val1' => $fileData1[$key], 'val2' => $fileData2[$key], 'flag' => 'mod'];
    }, $sortedKeys);
}
