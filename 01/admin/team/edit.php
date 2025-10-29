<?php
require_once __DIR__ . '/../../lib/team.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = team_get($id); // use team_get, not products_get
if (!$item) {
    http_response_code(404);
    echo "Team member not found";
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $bio = trim($_POST['bio'] ?? '');

    if ($name === '') $errors[] = "Name required.";
    if ($role === '') $errors[] = "Role required.";

    if (empty($errors)) {
        $updated = team_update($id, [
            'name' => $name,
            'role' => $role,
            'bio' => $bio
        ]);
        $item = $updated;
        $saved = true;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Team Member</title></head>
<body>
  <h1>Edit Team Member</h1>
  <?php if (!empty($saved)) echo "<p style='color:green'>Saved.</p>"; ?>
  <?php if ($errors): ?><ul style="color:red"><?php foreach ($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul><?php endif; ?>

  <form method="post">
    <label>Name<br /><input name="name" value="<?php echo htmlspecialchars($item['name']); ?>"></label><br>
    <label>Role<br /><input name="role" value="<?php echo htmlspecialchars($item['role']); ?>"></label><br>
    <label>Bio<br /><textarea name="bio"><?php echo htmlspecialchars($item['bio']); ?></textarea></label><br>
    <button type="submit">Save changes</button>
  </form>

  <p><a href="detail.php?id=<?php echo $id; ?>">View</a> | <a href="index.php">Back to list</a></p>
</body>
</html>
