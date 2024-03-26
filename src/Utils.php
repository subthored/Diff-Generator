<?php

namespace utils;

function boolToString(bool $boolValue)
{
    return $strValue = $boolValue === true ? 'true' : 'false';
}
