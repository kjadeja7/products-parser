<?php
namespace App;
use App\csvfileparse;
use App\parserInterface;
class ParserFactory
{
    public static function createParser($fileType): ParserInterface
    {
        switch (strtolower($fileType)) {
            case 'csv':
                return new csvfileparse();
            // case 'json':
            //     return new JSONParser();
            // case 'xml':
            //     return new XMLParser();
            default:
                throw new \Exception("Unsupported file type: {$fileType}");
        }
    }
}
