<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id']) || !isset($_POST['model_slug']) || !isset($_POST['vote'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$model_slug = $_POST['model_slug'];
$vote = $_POST['vote'] === 'yes' ? 'yes' : 'no';

// Проверка дали потребителят вече е гласувал
$stmt = $connection->prepare("SELECT * FROM model_votes WHERE user_id = :user_id AND model_slug = :model_slug");
$stmt->execute([
    ':user_id' => $user_id,
    ':model_slug' => $model_slug
]);

if ($stmt->rowCount() === 0) {
    // Записване на гласа
    $insert = $connection->prepare("INSERT INTO model_votes (user_id, model_slug, vote) VALUES (:user_id, :model_slug, :vote)");
    $insert->execute([
        ':user_id' => $user_id,
        ':model_slug' => $model_slug,
        ':vote' => $vote
    ]);
}

// Пренасочване обратно към страницата на модела
header("Location: models/" . $model_slug . ".php");
exit();
