<?php
require 'database/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM todos WHERE id = ?");
$stmt->execute([$id]);
$todo = $stmt->fetch();

if (!$todo) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Todo</title>
</head>
<body>
  <h1>Edit Todo</h1>
  <form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
    <label>Title: <input type="text" name="title" value="<?php echo htmlspecialchars($todo['title']); ?>" required></label>
    <label>Due date: <input type="date" name="due_date" value="<?php echo ($todo['due_date'] ?? ''); ?>"></label>
    <label>Completed: <input type="checkbox" name="completed" value="1" <?php echo $todo['completed'] ? 'checked' : ''; ?>></label>
    <button type="submit">Save</button>
  </form>
  <p><a href="index.php">Back</a></p>
</body>
</html>
