<?php
include '../../lib/readCSV.php';

$pages = readCSVFile('../../data/pages.csv');
$id = $_GET['id'] ?? null;

if ($id === null || !isset($pages[$id])) {
  die("Product not found.");
}
$page = $pages[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Details</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Page Details</h2>
  <table class="table table-striped w-50">
    <?php foreach ($page as $key => $value): ?>
      <tr>
        <th><?= htmlspecialchars($key) ?></th>
        <td><?= htmlspecialchars($value) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="edit.php?id=<?= $id ?>" class="btn btn-warning">Edit</a>
  <a href="delete.php?id=<?= $id ?>" class="btn btn-danger">Delete</a>
  <a href="index.php" class="btn btn-secondary">Back</a>
</body>
</html>
