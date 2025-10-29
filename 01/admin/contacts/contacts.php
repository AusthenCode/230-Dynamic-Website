<?php
// Correct paths to the library files
require_once __DIR__ . '/../../lib/storage.php';
require_once __DIR__ . '/../../lib/readCSV.php';

// Define the CSV file path
define('CONTACTS_FILE', __DIR__ . '/../../data/contacts.csv');

// Retrieve all contact requests
function contacts_all(): array {
    if (!file_exists(CONTACTS_FILE)) return [];
    
    $rows = array_map('str_getcsv', file(CONTACTS_FILE));
    if (empty($rows)) return [];
    
    $header = array_shift($rows);
    $contacts = [];
    foreach ($rows as $row) {
        if (count($row) === count($header)) {
            $contacts[] = array_combine($header, $row);
        }
    }
    return $contacts;
}

// Retrieve a single contact request by ID
function contacts_get(int $id): ?array {
    foreach (contacts_all() as $contact) {
        if ((int)$contact['id'] === $id) return $contact;
    }
    return null;
}

// Create a new contact request
function contacts_create(array $data): array {
    $items = contacts_all();
    $new = [
        'id' => nextId($items),
        'name' => $data['name'] ?? '',
        'email' => $data['email'] ?? '',
        'message' => $data['message'] ?? '',
        'created_at' => date('c')
    ];
    $items[] = $new;
    writeCSVFile(CONTACTS_FILE, $items);
    return $new;
}

// Delete a contact request by ID
function contacts_delete(int $id): bool {
    $items = contacts_all();
    $new = [];
    $found = false;
    foreach ($items as $contact) {
        if ((int)$contact['id'] === $id) {
            $found = true;
            continue;
        }
        $new[] = $contact;
    }
    if ($found) writeCSVFile(CONTACTS_FILE, $new);
    return $found;
}
?>
