<?php
require_once __DIR__ . '/../../lib/Team.php';
$teamMembers = Team::all();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Team Management</title>
</head>
<body>
  <h1>Team Members</h1>
  <a href="../index.php">Admin Dashboard</a>
  <a href="create.php">Add New Member</a>

  <?php if (empty($teamMembers)): ?>
    <p>No team members found.</p>
  <?php else: ?>
    <table border="1" cellpadding="5">
      <tr><th>#</th><th>Name</th><th>Role</th><th>Bio</th><th>Actions</th></tr>
      <?php foreach ($teamMembers as $i => $member): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($member['name']) ?></td>
          <td><?= htmlspecialchars($member['role']) ?></td>
          <td><?= htmlspecialchars($member['bio']) ?></td>
          <td>
            <a href="edit.php?id=<?= $i ?>">Edit</a>
            <a href="delete.php?id=<?= $i ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</body>
</html>
