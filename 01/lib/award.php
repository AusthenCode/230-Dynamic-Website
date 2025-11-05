<?php
require_once __DIR__ . '/CSVHelper.php';

class Award {
    private static $file = __DIR__ . '/../data/awards.csv';
    public static function all(): array {
        return CSVHelper::read(self::$file);
    }
    public static function find(int $index): ?array {
        $awards = self::all();
        return $awards[$index] ?? null;
    }
    public static function create(array $data): void {
        $awards = self::all();
        $awards[] = [
            'title'       => $data['title'] ?? '',
            'year'        => $data['year'] ?? '',
            'description' => $data['description'] ?? '',
        ];
        CSVHelper::write(self::$file, ['title', 'year', 'description'], $awards);
    }
    public static function update(int $index, array $data): void {
        $awards = self::all();
        if (isset($awards[$index])) {
            $awards[$index]['title'] = $data['title'] ?? $awards[$index]['title'];
            $awards[$index]['year'] = $data['year'] ?? $awards[$index]['year'];
            $awards[$index]['description'] = $data['description'] ?? $awards[$index]['description'];
            CSVHelper::write(self::$file, ['title', 'year', 'description'], $awards);
        }
    }
    public static function delete(int $index): void {
        $awards = self::all();
        if (isset($awards[$index])) {
            unset($awards[$index]);
            $awards = array_values($awards);
            CSVHelper::write(self::$file, ['title', 'year', 'description'], $awards);
        }
    }
}
?>
