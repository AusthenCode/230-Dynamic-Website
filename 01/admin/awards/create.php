<?php
require_once __DIR__ . '/../../lib/award.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Award::create($_POST);
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Award</title></head>
<body>
<h1>Add New Award</h1>
<form method="post">
  <label>Title:<br><input name="title" required></label><br>
  <label>Year:<br><input name="year" required></label><br>
  <label>Description:<br><textarea name="description"></textarea></label><br>
  <button type="submit">Create</button>
</form>
<a href="index.php">⬅ Back to Awards</a>
</body>
</html>
