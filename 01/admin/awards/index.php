<?php
include '../../lib/readCSV.php';

$awards = readCSVFile('../../data/awards.csv');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Awards</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Awards</h2>
  <a href="create.php" class="btn btn-primary mb-3">+ Add a New Award</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <?php if (!empty($awards)): ?>
          <?php foreach (array_keys($awards[0]) as $header): ?>
            <th><?= htmlspecialchars($header) ?></th>
          <?php endforeach; ?>
          <th>Actions</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($awards as $index => $award): ?>
        <tr>
          <?php foreach ($award as $value): ?>
            <td><?= htmlspecialchars($value) ?></td>
          <?php endforeach; ?>
          <td>
            <a href="detail.php?id=<?= $index ?>" class="btn btn-sm btn-info">View</a>
            <a href="edit.php?id=<?= $index ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= $index ?>" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
