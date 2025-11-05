<?php
require_once __DIR__ . '/../../lib/award.php';
$id = (int)($_GET['id'] ?? 0);
Award::delete($id);
header('Location: index.php');
exit;
?>
