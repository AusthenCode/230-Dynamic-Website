<?php
require_once '../../lib/readCSV.php';

$filename = '../../data/pages.csv';

// Read existing data safely
$pages = file_exists($filename) ? readCSVFile($filename) : [];

// Extract headers or define defaults
$headers = !empty($pages) ? array_keys($pages[0]) : ['title', 'content'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPage = [];
    foreach ($headers as $header) {
        $newPage[$header] = $_POST[$header] ?? '';
    }

    // Open file and append new row
    $fp = fopen($filename, 'a');
    if ($fp) {
        // Add header row if file was empty
        if (filesize($filename) === 0) {
            fputcsv($fp, $headers);
        }
        fputcsv($fp, $newPage);
        fclose($fp);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Page</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1>Create New Page</h1>
    <form method="POST">
        <?php foreach ($headers as $header): ?>
            <div class="mb-3">
                <label class="form-label"><?= ucfirst($header) ?></label>
                <input type="text" name="<?= $header ?>" class="form-control" required>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
