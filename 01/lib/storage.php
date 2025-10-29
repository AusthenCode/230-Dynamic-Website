<?php

function readJsonFile(string $path): array {
    if (!file_exists($path)) {
        return [];
    }
    $contents = file_get_contents($path);
    $data = json_decode($contents, true);
    return is_array($data) ? $data : [];
}

function writeJsonFile(string $path, array $data): bool {
    // Use LOCK_EX for safe write
    $tmp = tempnam(sys_get_temp_dir(), 'tmp');
    if ($tmp === false) return false;
    file_put_contents($tmp, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    // atomic replace
    $result = rename($tmp, $path);
    return $result;
}

function nextId(array $items): int {
    $max = 0;
    foreach ($items as $it) {
        if (isset($it['id']) && is_numeric($it['id'])) {
            $max = max($max, (int)$it['id']);
        }
    }
    return $max + 1;
}
?>
