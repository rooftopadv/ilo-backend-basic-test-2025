<?php
// index.php

// Διαβάζουμε τα tasks από το tasks.json
$tasks = json_decode(file_get_contents('tasks.json'), true);

// Διαχείριση φόρμας υποβολής
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (strlen($title) < 3) {
        $error = 'Ο τίτλος πρέπει να έχει τουλάχιστον 3 χαρακτήρες';
    } else {
        $id = 1;
        if (!empty($tasks)) {
            $ids = array_column($tasks, 'id');
            $id = max($ids) + 1;
        }
        $newTask = [
            'id' => $id,
            'title' => htmlspecialchars($title),
            'description' => htmlspecialchars($description),
            'is_done' => false
        ];
        $tasks[] = $newTask;
        file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backend Basic Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Backend Basic Test</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="index.php">
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <button type="submit">Προσθήκη Task</button>
    </form>
    <h2>Tasks</h2>
    <ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <input type="checkbox" data-id="<?php echo $task['id']; ?>" <?php echo $task['is_done'] ? 'checked' : ''; ?>>
            <span class="<?php echo $task['is_done'] ? 'done' : ''; ?>">
                <?php echo $task['title']; ?> - <?php echo $task['description']; ?>
            </span>
        </li>
    <?php endforeach; ?>
    </ul>
    <script src="script.js"></script>
</body>
</html>
