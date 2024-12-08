<?php

use App\product;
use PHPUnit\Framework\TestCase;

class productTest extends TestCase
{
    public function testProductInitialization()
    {
        $product = new product('Apple', 'iPhone 6s Plus', 'Red', '256GB', 'Unlocked', 'Grade A', 'Working');
        
        $this->assertEquals('Apple', $product->make);
        $this->assertEquals('iPhone 6s Plus', $product->model);
        $this->assertEquals('Red', $product->colour);
        $this->assertEquals('256GB', $product->capacity);
        $this->assertEquals('Unlocked', $product->network);
        $this->assertEquals('Grade A', $product->grade);
        $this->assertEquals('Working', $product->condition);
    }
}
