<?php

use App\csvfileparse;
use App\productGrouping;
use App\fileWriter;
use PHPUnit\Framework\TestCase;

class fileWriterTest extends TestCase
{
    private $fileWriter;

    protected function setUp(): void
    {
        $csvfileparse = new csvfileparse();
        $productGrouping = new productGrouping();
        $this->fileWriter = new fileWriter($csvfileparse, $productGrouping);
    }

    public function testProcessFileAndGenerateCombinations()
    {
        $csvData = "make,model,colour,capacity,network,grade,condition\nApple,iPhone 6s Plus,Red,256GB,Unlocked,Grade A,Working";
        file_put_contents('test.csv', $csvData);

        $this->fileWriter->process('test.csv', 'output.csv');

        $this->assertFileExists('output.csv');

        // Check the generated file contents
        $content = file_get_contents('output.csv');
        $this->assertStringContainsString('Apple,iPhone-6s-Plus,Red,256GB,Unlocked,Grade-A,Working,1', $content);

        // Cleanup
        unlink('test.csv');
        unlink('output.csv');
    }
}

