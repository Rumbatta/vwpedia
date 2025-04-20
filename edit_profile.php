<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_password = $_POST['password'];

    // Проверка дали се сменя потребителското име
    if ($new_username !== $user['username']) {
        $stmt = $connection->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$new_username, $user['id']]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $message = "Потребителското име вече е заето.";
        } else {
            // Подготвяме заявката според това дали има нова парола
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $connection->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
                $stmt->execute([$new_username, $hashed_password, $user['id']]);
                $_SESSION['user']['password'] = $hashed_password;
            } else {
                $stmt = $connection->prepare("UPDATE users SET username = ? WHERE id = ?");
                $stmt->execute([$new_username, $user['id']]);
            }

            $_SESSION['user']['username'] = $new_username;
            $message = "Профилът е обновен успешно!";
        }
    } else {
        // Ако потребителското име не се променя, проверяваме само паролата
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user['id']]);
            $_SESSION['user']['password'] = $hashed_password;
            $message = "Паролата е обновена успешно!";
        } else {
            $message = "Няма промени за запазване.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Профил</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-container {
        max-width: 400px;
        margin: 80px auto;
        background: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0);
        text-align: center;
        color: #222;
      }

      .auth-container h2 {
        margin-bottom: 20px;
        font-size: 24px;
      }

      .auth-container input {
        display: block;
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: none;
        background: rgba(134, 129, 129, 0.12);
        color: #222;
      }

      .auth-container button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .auth-container button:hover {
        background-color: #0056b3;
      }

      .edit-btn {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #17a2b8;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
      }

      .edit-btn:hover {
        background-color: #117a8b;
      }

      body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: url('images/vw-bg.jpg') no-repeat center center fixed; 
        background-size: cover;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }


    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
  <div class="auth-container">
    <h2>Редактиране на профил</h2>
    <?php if ($message) echo "<p style='color: green;'>$message</p>"; ?>
    <form method="post">
      <p>Ново име:</p>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Въведете ново име" required>
      <p>Нова парола:</p>
      <input type="password" name="password" placeholder="Въведете нова парола" required>
      <br><button type="submit" name="update">Запази промените</button></br>
    </form>
    <a href="profile.php" class="edit-btn">Назад към профила</a>
  </div>
</main>


<?php include 'footer.php'; ?>
