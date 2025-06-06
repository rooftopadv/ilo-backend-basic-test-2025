<?php
// toggle.php

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing id']);
    exit;
}
$id = intval($_GET['id']);
$tasks = json_decode(file_get_contents('tasks.json'), true);
$found = false;
foreach ($tasks as &$task) {
    if ($task['id'] === $id) {
        $task['is_done'] = !$task['is_done'];
        $found = true;
        $updatedTask = $task;
        break;
    }
}
if (!$found) {
    http_response_code(404);
    echo json_encode(['error' => 'Task not found']);
    exit;
}
file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
echo json_encode($updatedTask);
