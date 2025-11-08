<?php
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $due_date = $_POST['due_date'] ?: null; // empty string -> null

    if ($title === '') {
        header('Location: index.php?error=empty_title');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO todos (title, due_date) VALUES (?, ?)");
    $stmt->execute([$title, $due_date]);
}

header('Location: index.php');
exit;
