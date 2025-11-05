<?php
class CSVHelper {
    // Read CSV
    public static function read(string $file): array {
        if (!file_exists($file)) return [];
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        $data = [];
        foreach ($rows as $row) {
            if (count($row) === count($header)) {
                $data[] = array_combine($header, $row);
            }
        }
        return $data;
    }

    // Write CSV with optional header
    public static function write(string $file, array $header, array $data): void {
        $f = fopen($file, 'w');
        fputcsv($f, $header);
        foreach ($data as $row) {
            $line = [];
            foreach ($header as $key) {
                $line[] = $row[$key] ?? '';
            }
            fputcsv($f, $line);
        }
        fclose($f);
    }
}
?>
