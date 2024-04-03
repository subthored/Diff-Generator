<?php

namespace format;

use function stylishRender\renderStylish;
use function plainRender\renderPlain;

function format(array $array, string $formatter)
{
    if ($formatter === 'stylish') {
        return renderStylish($array);
    }

    if ($formatter === 'plain') {
        return renderPlain($array, $valuePath = "");
    }
}
