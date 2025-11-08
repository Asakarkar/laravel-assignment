<?php
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = trim($_POST['title'] ?? '');
    $due_date = $_POST['due_date'] ?: null;
    $completed = isset($_POST['completed']) ? 1 : 0;

    if (!$id || $title === '') {
        header('Location: index.php?error=invalid_input');
        exit;
    }

    $stmt = $pdo->prepare("UPDATE todos SET title = ?, due_date = ?, completed = ? WHERE id = ?");
    $stmt->execute([$title, $due_date, $completed, $id]);
}

header('Location: index.php');
exit;
