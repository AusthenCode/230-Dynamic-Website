<?php
require_once __DIR__ . '/../../lib/team.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'role' => $_POST['role'] ?? '',
        'bio'  => $_POST['bio'] ?? '',
        'image'=> $_POST['image'] ?? ''
    ];
    Team::create($data);
    header('Location: index.php');
    exit;
}
?>

<h1>Add New Team Member</h1>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Role:</label><br>
    <input type="text" name="role"><br><br>

    <label>Bio:</label><br>
    <textarea name="bio"></textarea><br><br>

    <label>Image URL:</label><br>
    <input type="text" name="image"><br><br>

    <button type="submit">Save</button>
</form>
