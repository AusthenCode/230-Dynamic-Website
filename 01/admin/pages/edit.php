<?php
include '../../lib/readCSV.php';

$filename = '../../data/pages.csv';
$pages = readCSVFile($filename);
$id = $_GET['id'] ?? null;

if ($id === null || !isset($pages[$id])) {
  die("Page not found.");
}

$headers = array_keys($pages[0]);
$page = $pages[$id];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($headers as $h) {
    $pages[$id][$h] = $_POST[$h] ?? '';
  }
  $fp = fopen($filename, 'w');
  fputcsv($fp, $headers);
  foreach ($pages as $p) fputcsv($fp, $p);
  fclose($fp);

  header('Location: detail.php?id=' . $id);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Page</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Edit Page</h2>
  <form method="post">
    <?php foreach ($headers as $h): ?>
      <div class="mb-3">
        <label class="form-label"><?= htmlspecialchars($h) ?></label>
        <input type="text" name="<?= htmlspecialchars($h) ?>" value="<?= htmlspecialchars($page[$h]) ?>" class="form-control" required>
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-success">Save Changes</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
