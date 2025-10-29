<?php
require_once __DIR__ . '/../../lib/team.php';

// Get all team members
$items = team_all();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Team</title>
    <link rel="stylesheet" href="../styles.css"> <!-- optional -->
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Team Members</h1>
    <p>
        <a href="create.php">Create New Team Member</a> | 
        <a href="../">Admin Home</a>
    </p>

    <?php if (empty($items)): ?>
        <p>No team members found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $it): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($it['id']); ?></td>
                        <td><a href="detail.php?id=<?php echo $it['id']; ?>"><?php echo htmlspecialchars($it['name']); ?></a></td>
                        <td><?php echo htmlspecialchars($it['role']); ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $it['id']; ?>">View</a> |
                            <a href="edit.php?id=<?php echo $it['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $it['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
