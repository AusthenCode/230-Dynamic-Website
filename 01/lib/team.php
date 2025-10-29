<?php
define('TEAM_FILE', __DIR__ . '/../data/team.csv');

// Read all team members
function team_all(): array {
    if (!file_exists(TEAM_FILE)) return [];
    $rows = array_map('str_getcsv', file(TEAM_FILE));
    $header = array_shift($rows);
    $team = [];
    foreach ($rows as $index => $row) {
        if (count($row) === count($header)) {
            $member = array_combine($header, $row);
            $member['id'] = $index + 1; // Auto-generate ID
            $team[] = $member;
        }
    }
    return $team;
}

// Get a single member by ID
function team_get(int $id): ?array {
    foreach (team_all() as $member) {
        if ($member['id'] === $id) return $member;
    }
    return null;
}

// Generate next ID
function nextTeamId(array $items): int {
    $max = 0;
    foreach ($items as $item) {
        if ($item['id'] > $max) $max = $item['id'];
    }
    return $max + 1;
}

// Create a new member
function team_create(array $data): array {
    $items = team_all();
    $new = [
        'id' => nextTeamId($items),
        'name' => $data['name'] ?? '',
        'role' => $data['role'] ?? '',
        'bio' => $data['bio'] ?? '',
        'image' => $data['image'] ?? ''
    ];
    $items[] = $new;

    // Rewrite CSV with updated data
    $header = ['name','role','bio','image'];
    $lines = [implode(',', $header)];
    foreach ($items as $m) {
        $lines[] = implode(',', [$m['name'],$m['role'],$m['bio'],$m['image']]);
    }
    file_put_contents(TEAM_FILE, implode("\n", $lines));

    return $new;
}

// Delete member
function team_delete(int $id): bool {
    $items = team_all();
    $new = [];
    $found = false;
    foreach ($items as $member) {
        if ($member['id'] === $id) { $found = true; continue; }
        $new[] = $member;
    }
    if ($found) {
        $header = ['name','role','bio','image'];
        $lines = [implode(',', $header)];
        foreach ($new as $m) {
            $lines[] = implode(',', [$m['name'],$m['role'],$m['bio'],$m['image']]);
        }
        file_put_contents(TEAM_FILE, implode("\n", $lines));
    }
    return $found;
}
?>
