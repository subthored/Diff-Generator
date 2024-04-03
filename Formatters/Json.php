<?php

namespace jsonRender;

function renderJson(array $diffArray): string
{
    return json_encode($diffArray, JSON_THROW_ON_ERROR);
}
