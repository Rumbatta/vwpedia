<?php
session_start();
include 'db_connection.php'; // връзка с базата

// Проверка дали потребителят е логнат
$isLoggedIn = isset($_SESSION['user_id']);
$model_id = $_GET['id'] ?? null;

// Проверка за вече даден вот
$hasVoted = false;
if ($isLoggedIn && $model_id) {
    $stmt = $conn->prepare("SELECT vote FROM model_votes WHERE user_id = ? AND model_id = ?");
    $stmt->bind_param("ii", $_SESSION['user_id'], $model_id);
    $stmt->execute();
    $stmt->store_result();
    $hasVoted = $stmt->num_rows > 0;
}
?>

<?php if ($isLoggedIn): ?>
    <?php if (!$hasVoted): ?>
        <form method="post" action="vote.php" style="margin-top: 20px;">
            <input type="hidden" name="model_id" value="<?= htmlspecialchars($model_id) ?>">
            <button type="submit" name="vote" value="yes" style="background-color: #4CAF50; color: white;">Да</button>
            <button type="submit" name="vote" value="no" style="background-color: #f44336; color: white;">Не</button>
        </form>
    <?php else: ?>
        <p style="margin-top: 20px; color: gray;">Вече сте гласували за този модел.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="margin-top: 20px; color: red;">Само регистрирани потребители могат да гласуват.</p>
<?php endif; ?>
