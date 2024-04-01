<?php

namespace Render;

const INDENT = 4;

function renderStylish($diffTree, int $level = 0)
{
    $indent = indentAmount($level, INDENT);
    $resultArray = array_map(function ($node) use ($level, $indent) {
        $depthOfTree = $level + 1;

        if ($node['flag'] === 'parent') {
            return "{$indent}    {$node['key']}: " . renderStylish($node['child'], $depthOfTree) . "\n";
        } elseif ($node['flag'] === 'add') {
            $val2 = stringConvert($node['val2'], $depthOfTree);
            return "{$indent}  + {$node['key']}: {$val2}\n";
        } elseif ($node['flag'] === 'rem') {
            $val1 = stringConvert($node['val1'], $depthOfTree);
            return "{$indent}  - {$node['key']}: {$val1}\n";
        } elseif ($node['flag'] === 'same') {
            $val1 = stringConvert($node['val1'], $depthOfTree);
            return "{$indent}    {$node['key']}: {$val1}\n";
        } elseif ($node['flag'] === 'mod') {
            $val1 = stringConvert($node['val1'], $depthOfTree);
            $val2 = stringConvert($node['val2'], $depthOfTree);
            // var_dump($val1);
            return "{$indent}  - {$node['key']}: {$val1}\n{$indent}  + {$node['key']}: {$val2}\n";
        }
    }, $diffTree);

    return "{\n" . implode("", $resultArray) . "{$indent}}";
}

function stringConvert($value, $level)
{
    if (is_bool($value)) {
        return $value === true ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if (!is_object($value)) {
        // var_dump($value);
        return (string) $value;
    }

    $indent = indentAmount($level, INDENT);
    $stringifyedArray = array_map(function ($key, $item) use ($level, $indent) {
        $depthOfTree = $level + 1;
        $dataType = (is_object($item)) ? stringConvert($item, $depthOfTree) : $item;
        return $indent . "    " . "$key: " . $dataType . "\n";
    }, array_keys(get_object_vars($value)), get_object_vars($value));

    return "{" . "\n" . implode("", $stringifyedArray) . $indent . "}";
}

function indentAmount($level, $indentAmount)
{
    return str_repeat(" ", $level * $indentAmount);
}
