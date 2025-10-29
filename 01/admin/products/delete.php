<?php
define('ROOT_PATH', dirname(__DIR__, 2) . '/'); // Goes up 2 levels from admin/subfolder/

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if confirmed, delete and redirect
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        products_delete($id);
        header('Location: index.php');
        exit;
    } else {
        header('Location: detail.php?id=' . $id);
        exit;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Delete Product</title></head>
<body>
  <h1>Delete Product #<?php echo $item['id']; ?></h1>
  <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($item['name']); ?></strong>?</p>
  <form method="post">
    <button name="confirm" value="yes" type="submit">Yes, delete</button>
    <button name="confirm" value="no" type="submit">No, cancel</button>
  </form>
  <p><a href="index.php">Back to list</a></p>
</body>
</html>
