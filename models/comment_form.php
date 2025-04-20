<?php
$conn = new mysqli("localhost", "root", "", "vwpedia");
if ($conn->connect_error) {
    die("Грешка при връзка с базата: " . $conn->connect_error);
}

$model = $_GET['model'] ?? 'general';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $stmt = $conn->prepare("INSERT INTO comments (model, username, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $model, $username, $comment);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT * FROM comments WHERE model='$model' ORDER BY created_at DESC");
?>

<h3>Коментари</h3>
<form method="post">
    <input type="text" name="username" placeholder="Име" required><br>
    <textarea name="comment" placeholder="Вашето мнение..." required></textarea><br>
    <button type="submit">Публикувай</button>
</form>

<?php while($row = $result->fetch_assoc()): ?>
    <p><strong><?= htmlspecialchars($row['username']) ?>:</strong> <?= nl2br(htmlspecialchars($row['comment'])) ?></p>
<?php endwhile; ?>
