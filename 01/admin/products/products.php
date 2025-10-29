<?php
// Correct path to storage.php
require_once __DIR__ . '/../../lib/storage.php'; 
require_once __DIR__ . '/../../lib/readCSV.php';
require_once __DIR__ . '/products.php';

define('PRODUCTS_FILE', __DIR__ . '/../../data/products.csv');

// Read all products
function products_all(): array {
    if (!file_exists(PRODUCTS_FILE)) return [];
    $rows = array_map('str_getcsv', file(PRODUCTS_FILE));
    $header = array_shift($rows);
    $products = [];
    foreach ($rows as $row) {
        if (count($row) === count($header)) { // only combine if counts match
            $products[] = array_combine($header, $row);
        }
    }
    return $products;
}


// Get a single product
function products_get(int $id): ?array {
    foreach (products_all() as $item) {
        if ((int)$item['id'] === $id) return $item;
    }
    return null;
}

// Create a new product
function products_create(array $data): array {
    $items = products_all();
    $new = [
        'id' => nextId($items),
        'name' => $data['name'] ?? '',
        'description' => $data['description'] ?? '',
        'price' => $data['price'] ?? '',
        'created_at' => date('c')
    ];
    $items[] = $new;
    writeCSVFile(PRODUCTS_FILE, $items); // <- write CSV instead of JSON
    return $new;
}

// Update a product
function products_update(int $id, array $data): ?array {
    $items = products_all();
    foreach ($items as &$item) {
        if ((int)$item['id'] === $id) {
            $item['name'] = $data['name'] ?? $item['name'];
            $item['description'] = $data['description'] ?? $item['description'];
            $item['price'] = $data['price'] ?? $item['price'];
            $item['updated_at'] = date('c');
            writeCSVFile(PRODUCTS_FILE, $items); // <- write CSV
            return $item;
        }
    }
    return null;
}

// Delete a product
function products_delete(int $id): bool {
    $items = products_all();
    $new = [];
    $found = false;
    foreach ($items as $item) {
        if ((int)$item['id'] === $id) { 
            $found = true; 
            continue; 
        }
        $new[] = $item;
    }
    if ($found) writeCSVFile(PRODUCTS_FILE, $new); 
    return $found;
}
?>
