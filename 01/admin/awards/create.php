<?php
$filepath = '../../data/awards.csv';

// Default headers for awards
$headers = ['title','year','description'];

// Read existing awards if file exists
$awards = [];
if (file_exists($filepath)) {
    if (($handle = fopen($filepath, 'r')) !== false) {
        $existingHeaders = fgetcsv($handle);
        if ($existingHeaders) $headers = $existingHeaders; // use headers from file if present
        while (($row = fgetcsv($handle)) !== false) {
            $awards[] = array_combine($headers, $row);
        }
        fclose($handle);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newAward = [];
    foreach ($headers as $header) {
        $newAward[$header] = $_POST[$header] ?? '';
    }
    $awards[] = $newAward;

    // Save back to CSV
    if (($handle = fopen($filepath, 'w')) !== false) {
        fputcsv($handle, $headers); // write header
        foreach ($awards as $a) {
            fputcsv($handle, $a);
        }
        fclose($handle);
    }

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Award</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h1 class="mb-4">Add New Award</h1>
    <form method="post">
        <?php foreach ($headers as $header): ?>
            <div class="mb-3">
                <label class="form-label"><?= ucfirst($header) ?></label>
                <input type="text" name="<?= $header ?>" class="form-control" required>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Add Award</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
