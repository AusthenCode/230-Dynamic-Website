<?php
require_once '../../lib/readCSV.php';

$filename = '../../data/pages.csv';
$pages = readCSVFile($filename);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pages - Admin</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4">Manage Pages</h1>
    <a href="create.php" class="btn btn-success mb-3">Create New Page</a>

    <?php if ($pages && count($pages) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?= htmlspecialchars($page['title']); ?></td>
                        <td><?= htmlspecialchars(substr($page['content'], 0, 50)); ?>...</td>
                        <td>
                            <a href="detail.php?title=<?= urlencode($page['title']); ?>" class="btn btn-info btn-sm">View</a>
                            <a href="edit.php?title=<?= urlencode($page['title']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?title=<?= urlencode($page['title']); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pages found.</p>
    <?php endif; ?>
</div>
<script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>

