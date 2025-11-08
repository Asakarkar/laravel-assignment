<?php
require 'database/db.php';
$today = date('Y-m-d');

$stmt = $pdo->prepare("SELECT * FROM todos WHERE due_date = ? AND completed = 0 ORDER BY due_date ASC, id DESC");
$stmt->execute([$today]);
$dueToday = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM todos ORDER BY completed ASC, due_date ASC, id DESC");
$todos = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Todo Web</title>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1e3d59;
      --accent: #28a745;
      --accent-hover: #218838;
      --bg-gradient: linear-gradient(135deg, #000000ff, #8d2ee6ff);
      --card-gradient: linear-gradient(135deg, #ffffff, #f5e6fbff);
      --text: #333;
      --muted: #6c757d;
      --link: #007bff;
      --link-hover: #0056b3;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Oswald', sans-serif;
      background: var(--bg-gradient);
      min-height: 100vh;
      margin: 0;
      padding: 32px 16px;
      color: var(--text);
      display: flex;
      flex-direction: column;
      align-items: center;
      animation: fadeIn 1s ease-in;
    }

    h1 {
      font-size: 40px;
      color: white;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.3);
      margin-bottom: 20px;
      animation: slideDown 1s ease-out;
    }

    h2 {
      font-size: 24px;
      color: var(--primary);
      margin-bottom: 12px;
      border-bottom: 2px solid #000000ff;
      padding-bottom: 4px;
      animation: fadeInUp 0.8s ease forwards;
    }

    section {
      margin-top: 24px;
      padding: 20px;
      background: var(--card-gradient);
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 800px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.9s ease forwards;
    }

    form label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="date"] {
      padding: 10px;
      width: 100%;
      max-width: 400px;
      border: 1px solid #000000ff;
      border-radius: 8px;
      font-size: 15px;
      font-family: 'Oswald', sans-serif;
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 6px rgba(40,167,69,0.4);
      outline: none;
    }

    button {
      margin-top: 16px;
      padding: 12px 24px;
      background: linear-gradient(135deg, #00871fff, #56b06aff);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      font-family: 'Oswald', sans-serif;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(0,0,0,0.2);
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      padding: 14px 10px;
      border-bottom: 1px dashed #ccc;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    li:hover {
      background: rgba(0,0,0,0.05);
      transform: scale(1.01);
    }

    .completed {
      color: var(--muted);
      text-decoration: line-through;
      animation: strike 0.6s ease forwards;
    }

    .meta {
      font-size: 13px;
      color: var(--muted);
      margin-left: 12px;
    }

    .actions a {
      margin-left: 12px;
      font-size: 14px;
      color: var(--link);
      text-decoration: none;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .actions a:hover {
      color: var(--link-hover);
      transform: translateY(-2px);
    }

    .actions a::before {
      margin-right: 4px;
      font-size: 14px;
    }

    .actions a[href*="complete"]::before { content: "✅"; }
    .actions a[href*="edit"]::before { content: "✏️"; }
    .actions a[href*="delete"]::before { content: "🗑️"; }

    p {
      font-size: 15px;
      color: var(--muted);
      margin: 8px 0;
      animation: fadeIn 1s ease-in;
    }

    @media (max-width: 600px) {
      li {
        flex-direction: column;
        align-items: flex-start;
      }

      .actions {
        margin-top: 8px;
      }
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideDown {
      from { transform: translateY(-30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes strike {
      0% { text-decoration: none; color: var(--text); }
      100% { text-decoration: line-through; color: var(--muted); }
    }
  </style>
</head>
<body>
  <h1>📝 Todo Web</h1>

  <section id="create">
    <h2>Create Todo</h2>
    <form action="create.php" method="post">
      <label>Title: <input type="text" name="title" required></label>
      <label>Due date: <input type="date" name="due_date"></label>
      <button type="submit">➕ Add Todo</button>
    </form>
  </section>

  <section id="due-today">
    <h2>Due Today (<?php echo htmlspecialchars($today); ?>)</h2>
    <?php if ($dueToday): ?>
      <ul>
        <?php foreach ($dueToday as $t): ?>
          <li>
            <span class="<?php echo $t['completed'] ? 'completed' : ''; ?>">
              <?php echo htmlspecialchars($t['title']); ?>
            </span>
            <span class="meta">Due: <?php echo ($t['due_date'] ?: '—'); ?></span>
            <span class="actions">
              <?php if (!$t['completed']): ?>
                <a href="complete.php?id=<?php echo $t['id']; ?>">Mark Completed</a>
              <?php endif; ?>
              <a href="edit.php?id=<?php echo $t['id']; ?>">Edit</a>
              <a href="delete.php?id=<?php echo $t['id']; ?>" onclick="return confirm('Delete this todo?')">Delete</a>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No todos due today. 🎉 Enjoy your free time!</p>
    <?php endif; ?>
  </section>

  <section id="all-todos">
    <h2>All Todos</h2>
    <?php if ($todos): ?>
    <ul>
      <?php foreach ($todos as $t): ?>
        <li>
          <span class="<?php echo $t['completed'] ? 'completed' : ''; ?>">
            <?php echo htmlspecialchars($t['title']); ?>
          </span>
          <span class="meta">Due: <?php echo ($t['due_date'] ?: '—'); ?></span>
          <span class="meta">Status: <?php echo $t['completed'] ? 'Completed' : 'Pending'; ?></span>
          <span class="actions">
            <?php if (!$t['completed']): ?>
              <a href="complete.php?id=<?php echo $t['id']; ?>">Mark Completed</a>
            <?php endif; ?>
            <a href="edit.php?id=<?php echo $t['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $t['id']; ?>" onclick="return confirm('Delete this todo?')">Delete</a>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
      <p>No todos yet — add one above and get productive! 🚀</p>
    <?php endif; ?>
  </section>
</body>
</html>
