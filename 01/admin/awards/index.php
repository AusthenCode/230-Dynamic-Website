<?php
require_once __DIR__ . '/../../lib/award.php';
$awards = Award::all();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Awards Management</title>
</head>
<body>
  <h1>Awards</h1>
  <a href="../index.php">Admin Dashboard</a>
  <a href="create.php">Add New Award</a>

  <?php if (empty($awards)): ?>
    <p>No awards found.</p>
  <?php else: ?>
    <table border="1" cellpadding="5">
      <tr><th>#</th><th>Title</th><th>Year</th><th>Description</th><th>Actions</th></tr>
      <?php foreach ($awards as $i => $award): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($award['title']) ?></td>
          <td><?= htmlspecialchars($award['year']) ?></td>
          <td><?= htmlspecialchars($award['description']) ?></td>
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
