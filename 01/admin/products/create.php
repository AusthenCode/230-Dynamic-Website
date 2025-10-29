<?php

define('ROOT_PATH', dirname(__DIR__, 2) . '/'); 

require_once ROOT_PATH . 'lib/storage.php';
require_once ROOT_PATH . 'lib/readCSV.php';
require_once ROOT_PATH . 'lib/readJSON.php';
require_once ROOT_PATH . 'lib/readText.php';


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // basic sanitation
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');

    if ($name === '') $errors[] = "Name is required.";

    if (empty($errors)) {
        $new = products_create([
            'name' => $name,
            'description' => $description,
            'price' => $price
        ]);
        // redirect to edit page for the created item
        header("Location: edit.php?id=" . $new['id']);
        exit;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create Product</title></head>
<body>
  <h1>Create Product</h1>
  <?php if ($errors): ?>
    <ul style="color:red"><?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?></ul>
  <?php endif; ?>

  <form method="post">
    <label>Name<br /><input name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"></label><br>
    <label>Price<br /><input name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"></label><br>
    <label>Description<br /><textarea name="description"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea></label><br>
    <button type="submit">Create</button>
  </form>

  <p><a href="index.php">Back to list</a></p>
</body>
</html>
