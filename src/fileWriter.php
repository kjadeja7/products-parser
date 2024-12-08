<?php

namespace App;

class fileWriter
{
    private $parser;
    private $productGrouping;

    public function __construct(parserInterface $parser, productGrouping $productGrouping)
    {
        $this->parser = $parser;
        $this->productGrouping = $productGrouping;
    }

    public function process($filePath, $outputFilePath)
    {
        //$products = $this->parser->parse($filePath);    
        $ext = pathinfo($filePath,PATHINFO_EXTENSION); // csv / xml / json
        $parser = ParserFactory::createParser($ext);
        $products = $parser->parse($filePath);

        foreach ($products as $product) {
            // echo "Product: " . implode(', ', [
            //     $product->make,
            //     $product->model,
            //     $product->colour,
            //     $product->capacity,
            //     $product->network,
            //     $product->grade,
            //     $product->condition
            // ]) . "\n";
        }

        $grouping = $this->productGrouping->generate($products);
        $this->productGrouping->save($grouping, $outputFilePath);
    }
}
