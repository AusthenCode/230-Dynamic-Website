<?php
require_once __DIR__ . '/../../lib/storage.php';
require_once __DIR__ . '/../../lib/readCSV.php';
require_once __DIR__ . '/products.php';

$items = products_all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Products</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 60px; background-color: #f8f9fa; }
        .card { margin-bottom: 20px; }
        .card-title { font-size: 1.2rem; }
        .btn-group a { margin-right: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mb-4">Products</h1>
    <p>
        <a href="create.php" class="btn btn-success">Create New Product</a>
        <a href="../" class="btn btn-secondary">Admin Home</a>
    </p>

    <?php if (empty($items)): ?>
        <div class="alert alert-warning">No products found.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($items as $it): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($it['name']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($it['description'])); ?></p>
                            <p class="text-muted"><strong>Price:</strong> $<?php echo htmlspecialchars($it['price'] ?? '0.00'); ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <a href="detail.php?id=<?php echo $it['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                <a href="edit.php?id=<?php echo $it['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $it['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
