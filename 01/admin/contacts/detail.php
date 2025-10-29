<?php
require_once __DIR__ . '/contacts.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = contacts_get($id);
if (!$item) { http_response_code(404); echo "Not found"; exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Contact #<?php echo $item['id']; ?></title></head>
<body>
  <h1>Contact Request #<?php echo $item['id']; ?></h1>
  <p><strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($item['email']); ?></p>
  <p><strong>Subject:</strong> <?php echo htmlspecialchars($item['subject'] ?? ''); ?></p>
  <p><strong>Message:</strong><br><?php echo nl2br(htmlspecialchars($item['message'] ?? '')); ?></p>
  <p><a href="index.php">Back to list</a></p>
</body></html>
