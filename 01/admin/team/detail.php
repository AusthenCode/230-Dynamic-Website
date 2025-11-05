<?php
require_once __DIR__ . '/../../lib/Team.php';

$id = $_GET['id'] ?? 0;
$member = Team::get((int)$id);

if (!$member) {
    http_response_code(404);
    echo "Team member not found";
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($member['name']); ?> - Team Member</title>
</head>
<body>
  <h1><?php echo htmlspecialchars($member['name']); ?></h1>
  <p><strong>Role:</strong> <?php echo htmlspecialchars($member['role']); ?></p>
  <p><strong>Bio:</strong> <?php echo nl2br(htmlspecialchars($member['bio'])); ?></p>
  <?php if (!empty($member['image'])): ?>
    <p><img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" width="200"></p>
  <?php endif; ?>
  
  <p>
    <a href="edit.php?id=<?php echo $member['id']; ?>">Edit</a> |
    <a href="delete.php?id=<?php echo $member['id']; ?>">Delete</a> |
    <a href="index.php">Back to list</a>
  </p>
</body>
</html>
