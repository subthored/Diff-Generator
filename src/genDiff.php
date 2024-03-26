<?php

namespace src;

use function Functional\sort;
use function boolToString;

function genDiff(string $file1, string $file2)
{
    if (!file_exists($file1) || !file_exists($file2)) {
        throw new \Exception('No such file!');
    }

    $fileData1 = json_decode(file_get_contents($file1, true), true);
    $fileData2 = json_decode(file_get_contents($file2, true), true);

    $mergedKeys = array_unique(array_merge(array_keys($fileData1), array_keys($fileData2)));
    $sortedKeys = sort($mergedKeys, fn($left, $right) => strcmp($left, $right));

    $diffArray = array_map(function ($key) use ($fileData1, $fileData2) {
        if (!array_key_exists($key, $fileData1)) {
            if (is_bool($fileData2[$key])) {
                $fileData2[$key] = $fileData2[$key] === true ? 'true' : 'false';
            }
            return ['key' => $key, 'val2' => "{$fileData2[$key]}", 'flag' => 'add'];
        }
        if (!array_key_exists($key, $fileData2)) {
            if (is_bool($fileData1[$key])) {
                $fileData1[$key] = $fileData1[$key] === true ? 'true' : 'false';
            }
            return ['key' => $key, 'val1' => "{$fileData1[$key]}", 'flag' => 'rem'];
        }
        if ($fileData1[$key] === $fileData2[$key]) {
            if (is_bool($fileData1[$key])) {
                $fileData1[$key] = $fileData1[$key] === true ? 'true' : 'false';
            }
            return ['key' => $key, 'val1' => "{$fileData1[$key]}", 'flag' => 'same'];
        }
        if (is_bool($fileData1[$key])) {
            $fileData1[$key] = $fileData1[$key] === true ? 'true' : 'false';
        }
        if (is_bool($fileData2[$key])) {
            $fileData2[$key] = $fileData2[$key] === true ? 'true' : 'false';
        }
        return ['key' => $key, 'val1' => "{$fileData1[$key]}", 'val2' => "{$fileData2[$key]}", 'flag' => 'mod'];
    }, $sortedKeys);

    return printArray($diffArray);
}

function printArray(array $diffArray)
{
    $resultStr = '';
    foreach ($diffArray as $row) {
        if ($row['flag'] === 'add') {
            $resultStr = $resultStr . "+ {$row['key']}: {$row['val2']}\n";
        } elseif ($row['flag'] === 'rem') {
            $resultStr = $resultStr . "- {$row['key']}: {$row['val1']}\n";
        } elseif ($row['flag'] === 'same') {
            $resultStr = $resultStr . "{$row['key']}: {$row['val1']}\n";
        } elseif ($row['flag'] === 'mod') {
            $resultStr = $resultStr . "- {$row['key']}: {$row['val1']}\n";
            $resultStr = $resultStr . "+ {$row['key']}: {$row['val2']}\n";
        }
    }

    return "{\n$resultStr}";
}
