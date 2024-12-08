<?php

use App\csvfileparse;
use App\product;
use PHPUnit\Framework\TestCase;

class csvfileparseTest extends TestCase
{
    private $csvParser;

    protected function setUp(): void
    {
        $this->csvParser = new csvfileparse();
    }

    public function testParseValidCSV()
    {
        $csvData = "make,model,colour,capacity,network,grade,condition\nApple,iPhone 6s Plus,Red,256GB,Unlocked,Grade A,Working";
        file_put_contents('test.csv', $csvData);

        $products = $this->csvParser->parse('test.csv');

        $this->assertCount(1, $products);
        $this->assertInstanceOf(product::class, $products[0]);
        $this->assertEquals('Apple', $products[0]->make);
    }

    public function testParseMissingRequiredField()
    {
        $csvData = "make,model,colour,capacity,network,grade\nApple,iPhone 6s Plus,Red,256GB,Unlocked,Grade A";
        file_put_contents('test.csv', $csvData);

        $this->expectException(\Exception::class);
        $this->csvParser->parse('test.csv');
    }

    protected function tearDown(): void
    {
        if (file_exists('test.csv')) {
            unlink('test.csv');
        }
    }
}
