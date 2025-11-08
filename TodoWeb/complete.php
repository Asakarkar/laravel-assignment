<?php
require 'database/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("UPDATE todos SET completed = 1 WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;

