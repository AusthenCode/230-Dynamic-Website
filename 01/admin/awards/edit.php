<?php
$filepath = '../../data/awards.csv';
$index = $_GET['index'] ?? null;

// Read existing awards
$awards = [];
if (file_exists($filepath)) {
    if (($handle = fopen($filepath, 'r')) !== false) {
        $headers = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            $awards[] = array_combine($headers, $row);
        }
        fclose($handle);
    }
}

// Default headers if file empty
if (!isset($headers) || !$headers) {
    $headers = ['title','year','description'];
}

if ($index === null || !isset($awards[$index])) {
    die("Award not found.");
}

$award = $awards[$index];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($headers as $header) {
        $awards[$index][$header] = $_POST[$header] ?? '';
    }

    // Save back to CSV
    if (($handle = fopen($filepath, 'w')) !== false) {
        fputcsv($handle, $headers);
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
    <title>Edit Award</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h1 class="mb-4">Edit Award</h1>
    <form method="post">
        <?php foreach ($headers as $header): ?>
            <div class="mb-3">
                <label class="form-label"><?= ucfirst($header) ?></label>
                <input type="text" name="<?= $header ?>" class="form-control" value="<?= htmlspecialchars($award[$header]) ?>" required>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
