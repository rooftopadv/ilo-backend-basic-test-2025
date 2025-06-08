<?php
// index.php

// Διαβάζουμε τα tasks από το tasks.json
$tasks = json_decode(file_get_contents('tasks.json'), true);

// Διαχείριση φόρμας υποβολής
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backend Basic Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Backend Basic Test</h1>
    <form method="" action="">
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <button type="submit">Προσθήκη Task</button>
    </form>
    <h2>Tasks</h2>
    <script src="script.js"></script>
</body>
</html>
