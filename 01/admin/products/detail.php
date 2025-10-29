<?php
require_once __DIR__ . '/../../lib/storage.php';
require_once __DIR__ . '/../../lib/readCSV.php';
require_once __DIR__ . '/products.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = products_get($id);

if (!$item) {
    http_response_code(404);
    echo "Product not found";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($item['name']); ?> - Product Detail</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 60px; background-color: #f8f9fa; }
        .card { max-width: 700px; margin: auto; }
        .card-title { font-size: 1.8rem; }
        .card-text { font-size: 1rem; }
        .btn-group a { margin-right: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-3"><?php echo htmlspecialchars($item['name']); ?></h2>
            <h5 class="text-muted mb-3">Price: $<?php echo htmlspecialchars($item['price'] ?? '0.00'); ?></h5>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
            <p class="text-muted"><small>Created: <?php echo htmlspecialchars($item['created_at'] ?? 'N/A'); ?></small></p>
            <?php if(!empty($item['updated_at'])): ?>
                <p class="text-muted"><small>Last Updated: <?php echo htmlspecialchars($item['updated_at']); ?></small></p>
            <?php endif; ?>

            <div class="btn-group mt-3" role="group">
                <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">Delete</a>
                <a href="index.php" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>
</div>

<script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
