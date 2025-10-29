<?php
require_once __DIR__ . '/../../lib/team.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = team_get($id); // <- use team_get instead of products_get
if (!$item) {
    http_response_code(404);
    echo "Team member not found";
    exit;
}

// Delete if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    team_delete($id); // <- use team_delete
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Delete Team Member</title></head>
<body>
  <h1>Delete Team Member</h1>
  <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($item['name']); ?></strong>?</p>

  <form method="post">
    <button type="submit">Yes, delete</button>
    <a href="index.php">Cancel</a>
  </form>
</body>
</html>
