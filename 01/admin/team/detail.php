<?php
// Include the team library
require_once __DIR__ . '/../../lib/team.php';


// Get the team member ID from the URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$member = team_get($id);

if (!$member) {
    http_response_code(404);
    echo "Team member not found";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Member - <?php echo htmlspecialchars($member['name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($member['name']); ?></h1>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($member['role']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($member['bio'])); ?></p>
    <p><img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" width="200"></p>
    <p>
        <a href="edit.php?id=<?php echo $member['id']; ?>">Edit</a> |
        <a href="delete.php?id=<?php echo $member['id']; ?>">Delete</a> |
        <a href="index.php">Back to list</a>
    </p>
</body>
</html>
