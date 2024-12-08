<?php

namespace App;

class productGrouping
{
    public function generate($products)
    {
        $grouping = [];

        foreach ($products as $product) {
            $key = implode('|', [
                $product->make,
                $product->model,
                $product->colour,
                $product->capacity,
                $product->network,
                $product->grade,
                $product->condition
            ]);

            if (!isset($grouping[$key])) {
                $grouping[$key] = 0;
            }

            $grouping[$key]++;
        }

        return $grouping;
    }

    public function save($groupings, $filePath)
    {
        $handle = fopen($filePath, 'w');

        if (!$handle) {
            throw new \Exception('Could not open output file for writing.');
        }

        fputcsv($handle, ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count']);

        foreach ($groupings as $key => $count) {
            $key = str_replace(" ","-",$key);
            fputcsv($handle, array_merge(explode('|', $key), [$count]));
        }

        fclose($handle);
    }
}
