<?php
require_once __DIR__ . '/../../lib/team.php';


$id = $_GET['id'] ?? null;
$member = $id ? Team::get((int)$id) : null;

if (!$member) {
    die("Member not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'role' => $_POST['role'] ?? '',
        'bio'  => $_POST['bio'] ?? '',
        'image'=> $_POST['image'] ?? ''
    ];
    Team::update((int)$id, $data);
    header('Location: index.php');
    exit;
}
?>

<h1>Edit Team Member</h1>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($member['name']) ?>" required><br><br>

    <label>Role:</label><br>
    <input type="text" name="role" value="<?= htmlspecialchars($member['role']) ?>"><br><br>

    <label>Bio:</label><br>
    <textarea name="bio"><?= htmlspecialchars($member['bio']) ?></textarea><br><br>

    <label>Image URL:</label><br>
    <input type="text" name="image" value="<?= htmlspecialchars($member['image']) ?>"><br><br>

    <button type="submit">Update</button>
</form>
