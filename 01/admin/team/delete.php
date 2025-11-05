<?php
require_once __DIR__ . '/../../lib/team.php';

$id = $_GET['id'] ?? null;

if ($id && Team::delete((int)$id)) {
    header('Location: index.php');
    exit;
} else {
    echo "Member not found or delete failed.";
}
?>
