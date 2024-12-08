<?php

namespace App;

class csvfileparse implements parserInterface
{
    public function parse($filePath)
    {
        $products = [];
        $handle = fopen($filePath, 'r');
        
        if (!$handle) {
            throw new \Exception('File could not be opened.');
        }

        $headers = fgetcsv($handle);

        if (!$headers || count($headers) < 7) {
            throw new \Exception('Required fields missing in CSV file.');
        }

        //$requiredFields = ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition'];
        $requiredFields = ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition'];
        $fieldIndices = array_flip($headers);

        // Ensure all required fields exist
        foreach ($requiredFields as $field) {
            if (!isset($fieldIndices[$field])) {
                throw new \Exception("Required field '{$field}' is missing in the CSV file.");
            }
        }

        // Parse the CSV and create Product objects
        while (($data = fgetcsv($handle)) !== false) {
            $products[] = new Product(
                $data[$fieldIndices['make']],
                $data[$fieldIndices['model']],
                $data[$fieldIndices['colour']] ?? '',
                $data[$fieldIndices['capacity']] ?? '',
                $data[$fieldIndices['network']] ?? '',
                $data[$fieldIndices['grade']] ?? '',
                $data[$fieldIndices['condition']] ?? ''
            );
        }

        fclose($handle);

        return $products;
    }
}
