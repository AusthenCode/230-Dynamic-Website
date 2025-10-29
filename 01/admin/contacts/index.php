<?php
// Correct paths to libraries and contacts functions
require_once __DIR__ . '/../../lib/storage.php';
require_once __DIR__ . '/../../lib/readCSV.php';
require_once __DIR__ . '/contacts.php'; // your contacts functions

$items = contacts_all();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Contacts</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding: 20px; }
    table { width: 100%; }
    th, td { text-align: left; padding: 8px; }
    th { background-color: #f2f2f2; }
    tr:nth-child(even) { background-color: #fafafa; }
  </style>
</head>
<body>
  <h1>Contact Requests</h1>
  <p><a href="../">Admin Home</a></p>

  <?php if (empty($items)): ?>
    <p>No contact requests found.</p>
  <?php else: ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Submitted</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($items as $it): ?>
        <tr>
          <td><?php echo htmlspecialchars($it['id']); ?></td>
          <td><a href="detail.php?id=<?php echo $it['id']; ?>"><?php echo htmlspecialchars($it['name']); ?></a></td>
          <td><?php echo htmlspecialchars($it['email']); ?></td>
          <td><?php echo htmlspecialchars($it['message'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($it['created_at'] ?? ''); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>

