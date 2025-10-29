<?php
// Include the team library
require_once __DIR__ . '/../../lib/team.php'; // correct path to team.php

$errors = [];
$saved = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $bio = trim($_POST['bio'] ?? '');

    if ($name === '') $errors[] = "Name is required.";
    if ($role === '') $errors[] = "Role is required.";

    if (empty($errors)) {
        $newMember = team_create([
            'name' => $name,
            'role' => $role,
            'bio' => $bio
        ]);
        $saved = true;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create Team Member</title>
</head>
<body>
  <h1>Create Team Member</h1>

  <?php if ($saved): ?>
    <p style="color:green;">Team member created successfully.</p>
  <?php endif; ?>

  <?php if ($errors): ?>
    <ul style="color:red;">
      <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
    </ul>
  <?php endif; ?>

  <form method="post">
    <label>Name:<br><input name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"></label><br>
    <label>Role:<br><input name=
