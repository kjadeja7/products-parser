<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\fileWriter;
use App\csvfileparse;
use App\productGrouping;

$options = getopt('', ['file:', 'unique-combinations:']);

if (!isset($options['file']) || !isset($options['unique-combinations'])) {
    die("Usage: php parser.php --file <input_file> --unique-combinations <output_file>\n");
}

$filePath = $options['file'];
$outputFilePath = $options['unique-combinations'];
$fileWriter = new fileWriter(new csvfileparse(),new productGrouping());
$fileWriter->process($filePath, $outputFilePath);