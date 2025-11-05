<?php
require_once __DIR__ . '/CSVHelper.php';

class Team {
    private static $file = __DIR__ . '/../data/team.csv';

    public static function all(): array {
        return CSVHelper::read(self::$file);
    }

    public static function get(int $index): ?array {
        $all = self::all();
        return $all[$index] ?? null;
    }

    public static function create(array $data): array {
        $all = self::all();
        $all[] = [
            'name' => $data['name'] ?? '',
            'role' => $data['role'] ?? '',
            'bio' => $data['bio'] ?? '',
            'image' => $data['image'] ?? ''
        ];
        CSVHelper::write(self::$file, $all);
        return end($all);
    }

    public static function update(int $index, array $data): bool {
        $all = self::all();
        if (!isset($all[$index])) return false;
        $all[$index] = array_merge($all[$index], $data);
        CSVHelper::write(self::$file, $all);
        return true;
    }

    public static function delete(int $index): bool {
        $all = self::all();
        if (!isset($all[$index])) return false;
        unset($all[$index]);
        CSVHelper::write(self::$file, array_values($all));
        return true;
    }
}
?>
