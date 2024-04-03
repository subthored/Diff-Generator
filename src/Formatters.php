<?php

namespace format;

use function stylishRender\renderStylish;
use function plainRender\renderPlain;
use function jsonRender\renderJson;

function format(array $array, string $formatter): string
{
    if ($formatter === 'stylish') {
        return renderStylish($array);
    }

    if ($formatter === 'plain') {
        return renderPlain($array, $valuePath = "");
    }

    if ($formatter === 'json') {
        return renderJson($array);
    }

    return "Invalid format. Supported is: stylish | plain | json .";
}
