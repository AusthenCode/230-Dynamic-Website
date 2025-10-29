<?php
include '../../lib/readCSV.php';

$filename = '../../data/pages.csv';
$awards = readCSVFile($filename);
$id = $_GET['id'] ?? null;

if ($id === null || !isset($awards[$id])) {
  die("Product not found.");
}

if (isset($_POST['confirm'])) {
  unset($awards[$id]);
  $awards = array_values($awards); // reindex

  $headers = array_keys($awards[0]);
  $fp = fopen($filename, 'w');
  fputcsv($fp, $headers);
  foreach ($awards as $p) fputcsv($fp, $p);
  fclose($fp);

  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete a Award</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Delete your Award</h2>
  <p>Are you sure you want to delete this award?</p>
  <form method="post">
    <button type="submit" name="confirm" class="btn btn-danger">Yes, Delete</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>