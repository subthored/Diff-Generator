<?php

namespace plainRender;

function renderPlain($diffTree, $valuePath)
{
    $resultArray = array_map(function ($node) use ($valuePath) {
        if ($node['flag'] === 'add') {
            $val2 = makeString($node['val2']);
            return "Property '$valuePath{$node['key']}' was added with value: {$val2}\n";
        } elseif ($node['flag'] === 'rem') {
            $val1 = makeString($node['val1']);
            return "Property '$valuePath{$node['key']}' was removed\n";
        } elseif ($node['flag'] === 'mod') {
            $val1 = makeString($node['val1']);
            $val2 = makeString($node['val2']);
            // var_dump($val1);
            return "Property '$valuePath{$node['key']}' was updated. From {$val1} to {$val2}\n";
        } elseif ($node['flag'] === 'parent') {
            $path = "$valuePath{$node['key']}.";
            return renderPlain($node['child'], $path);
        }
    }, $diffTree);

    return implode("", $resultArray);
}

function makeString($value)
{
    if (is_object($value)) {
        // var_dump($value);
        return "[complex value]";
    }
    if (is_bool($value)) {
        return $value === true ? 'true' : 'false';
    }

    return strtolower(var_export($value, true));
}
