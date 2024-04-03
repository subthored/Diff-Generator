<?php

namespace Parser;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $file): object
{
    $fileData = (string) file_get_contents($file, true);
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    return match ($extension) {
        'json' => json_decode($fileData),
        'yml', 'yaml' => Yaml::parse($fileData, Yaml::PARSE_OBJECT_FOR_MAP),
        default => throw new \Exception('No such file!'),
    };
}
