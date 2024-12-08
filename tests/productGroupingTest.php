<?php

use App\product;
use App\productGrouping;
use PHPUnit\Framework\TestCase;

class productGroupingTest extends TestCase
{
    private $productGrouping;

    protected function setUp(): void
    {
        $this->productGrouping = new productGrouping();
    }

    public function testGenerateproductGrouping()
    {
        $products = [
            new product('Apple', 'iPhone 6s Plus', 'Red', '256GB', 'Unlocked', 'Grade A', 'Working'),
            new product('Apple', 'iPhone 6s Plus', 'Red', '256GB', 'Unlocked', 'Grade A', 'Working'),
            new product('Apple', 'iPhone 6s Plus', 'Blue', '128GB', 'Unlocked', 'Grade B', 'Not Working')
        ];

        $grouping = $this->productGrouping->generate($products);

        $this->assertCount(2, $grouping);
        $this->assertEquals(2, $grouping['Apple|iPhone 6s Plus|Red|256GB|Unlocked|Grade A|Working']);
        $this->assertEquals(1, $grouping['Apple|iPhone 6s Plus|Blue|128GB|Unlocked|Grade B|Not Working']);
    }

    public function testSaveGrouping()
    {
        $grouping = [
            'Apple|iPhone 6s Plus|Red|256GB|Unlocked|Grade A|Working' => 2,
            'Apple|iPhone 6s Plus|Blue|128GB|Unlocked|Grade B|Not Working' => 1
        ];

        $this->productGrouping->save($grouping, 'grouping.csv');

        $this->assertFileExists('grouping.csv');

        // deleting combination file
        unlink('grouping.csv');
    }
}
