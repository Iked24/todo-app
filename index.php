<?php
// Подключаемся к Redis
$redis = new Redis();
try {
    $redis->connect('redis', 6379); // 'redis' — имя сервиса в Docker Compose
} catch (Exception $e) {
    die("Не удалось подключиться к Redis: " . $e->getMessage());
}

// Ключ для хранения задач в Redis
$redisKey = 'tasks';

// Загружаем задачи из Redis
$rawTasks = $redis->get($redisKey);
$tasks = is_string($rawTasks) ? json_decode($rawTasks, true) : [];
// Если данные некорректны или отсутствуют, используем пустой массив
if (!is_array($tasks)) {
    $tasks = [];
}

// Обработка добавления задачи
if (isset($_POST['task']) && !empty(trim($_POST['task']))) {
    $tasks[] = [
        'text' => $_POST['task'],
        'done' => false
    ];
    $redis->set($redisKey, json_encode($tasks));
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список задач</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 10px 0; }
    </style>
</head>
<body>
<h1>Список задач</h1>
<form method="POST">
    <input type="text" name="task" placeholder="Введите задачу">
    <button type="submit">Добавить</button>
</form>
<ul>
    <?php foreach ($tasks as $index => $task): ?>
        <li>
            <input type="checkbox" <?php echo $task['done'] ? 'checked' : ''; ?>>
            <?php echo htmlspecialchars($task['text']); ?>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>