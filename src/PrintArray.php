<?php

namespace Render;

function printArray(array $diffArray)
{
    $resultStr = '';
    // var_dump($diffArray);
    foreach ($diffArray as $row) {
        if ($row['flag'] === 'add') {
            $val2 = stringConvert($row['val2']);
            $resultStr = $resultStr . "+ " . $row['key'] . ": " . $val2 . "\n";
        } elseif ($row['flag'] === 'rem') {
            $val1 = stringConvert($row['val1']);
            $resultStr = $resultStr . "- " . $row['key'] . ": " . $val1 . "\n";
        } elseif ($row['flag'] === 'same') {
            $val1 = stringConvert($row['val1']);
            $resultStr = $resultStr . $row['key'] . ": " . $val1 . "\n";
        } elseif ($row['flag'] === 'mod') {
            $val1 = stringConvert($row['val1']);
            // var_dump($val1);
            $val2 = stringConvert($row['val2']);
            $resultStr = $resultStr . "- " . $row['key'] . ": " . $val1 . "\n";
            $resultStr = $resultStr . "+ " . $row['key'] . ": " . $val2 . "\n";
        }
    }

    return "{\n$resultStr}";
}

function stringConvert($value)
{
    if (is_bool($value)) {
        return $value === true ? 'true' : 'false';
    }
    if (!is_object($value)) {
        return (string) $value;
    }
    return $value;
}
