<?php

namespace Parser;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $file): object
{
    if (!file_exists($file)) {
        throw new \Exception('No such file!');
    }

    $fileData = (string) file_get_contents($file, true);
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    // var_dump($extension);

    if ($extension === 'json') {
        $returnData = json_decode($fileData);
    }
    if ($extension === 'yml' || $extension === 'yaml') {
        $returnData = Yaml::parse($fileData, Yaml::PARSE_OBJECT_FOR_MAP);
    }

    return $returnData;
}
