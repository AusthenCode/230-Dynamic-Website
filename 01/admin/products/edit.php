<?php
define('ROOT_PATH', dirname(__DIR__, 2) . '/'); // Goes up 2 levels from admin/subfolder/

// Include library files
require_once ROOT_PATH . 'lib/storage.php';
require_once ROOT_PATH . 'lib/readCSV.php';
require_once ROOT_PATH . 'lib/readJSON.php';
require_once ROOT_PATH . 'lib/readText.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = products_get($id);
if (!$item) {
    http_response_code(404);
    echo "Product not found";
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');

    if ($name === '') $errors[] = "Name required.";

    if (empty($errors)) {
        $updated = products_update($id, [
            'name' => $name,
            'description' => $description,
            'price' => $price
        ]);
        // reload updated data
        $item = $updated;
        $saved = true;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Product</title></head>
<body>
  <h1>Edit Product #<?php echo $item['id']; ?></h1>
  <?php if (!empty($saved)) echo "<p style='color:green'>Saved.</p>"; ?>
  <?php if ($errors): ?><ul style="color:red"><?php foreach ($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul><?php endif; ?>

  <form method="post">
    <label>Name<br /><input name="name" value="<?php echo htmlspecialchars($item['name']); ?>"></label><br>
    <label>Price<br /><input name="price" value="<?php echo htmlspecialchars($item['price'] ?? ''); ?>"></label><br>
    <label>Description<br /><textarea name="description"><?php echo htmlspecialchars($item['description']); ?></textarea></label><br>
    <button type="submit">Save changes</button>
  </form>

  <p><a href="detail.php?id=<?php echo $item['id']; ?>">View</a> | <a href="index.php">Back to list</a></p>
</body>
</html>
