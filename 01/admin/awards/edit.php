<?php
require_once __DIR__ . '/../../lib/award.php';
$id = (int)($_GET['id'] ?? 0);
$award = Award::find($id);
if (!$award) {
    echo "Award not found";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Award::update($id, $_POST);
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Award</title></head>
<body>
<h1>Edit Award</h1>
<form method="post">
  <label>Title:<br><input name="title" value="<?= htmlspecialchars($award['title']) ?>"></label><br>
  <label>Year:<br><input name="year" value="<?= htmlspecialchars($award['year']) ?>"></label><br>
  <label>Description:<br><textarea name="description"><?= htmlspecialchars($award['description']) ?></textarea></label><br>
  <button type="submit">Save Changes</button>
</form>
<a href="index.php">⬅ Back to Awards</a>
</body>
</html>
