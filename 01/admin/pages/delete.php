<?php
include '../../lib/readCSV.php';

$filename = '../../data/pages.csv';
$pages = readCSVFile($filename);
$id = $_GET['id'] ?? null;

if ($id === null || !isset($pages[$id])) {
  die("Product not found.");
}

if (isset($_POST['confirm'])) {
  unset($pages[$id]);
  $pages = array_values($pages); // reindex

  $headers = array_keys($pages[0]);
  $fp = fopen($filename, 'w');
  fputcsv($fp, $headers);
  foreach ($pages as $p) fputcsv($fp, $p);
  fclose($fp);

  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete a Page</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Delete Page</h2>
  <p>Are you sure you want to delete this page?</p>
  <form method="post">
    <button type="submit" name="confirm" class="btn btn-danger">Yes, Delete</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
