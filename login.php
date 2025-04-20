<?php 
$registeredSuccess = false;
if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    $registeredSuccess = true;
}

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "vwpedia";

require 'db_connection.php'; 


$error = ""; // Променлива за съобщение за грешка

if (isset($_POST['submit'])) {
  $username = $_POST['username'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
  $stmt->execute([$username, $email]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      $_SESSION['user_id'] = $user['id'];
      header("location: index.php");
      exit;
  } else {
      $error = "Невалидни потребителски данни.";
  }
}

    
?> 


<html>
<head>
<meta charset="UTF-8">
  <title>VWpedia</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .auth-container {
    max-width: 400px;
    margin: 60px auto;
    padding: 30px;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
    }

    .auth-container h2 {
    margin-bottom: 20px;
    color: #333;
    }

    .auth-container input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.2s;
    }

    .auth-container input:focus {
    border-color: #007BFF;
    outline: none;
    }

    .auth-container button {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    }

    .auth-container button:hover {
    background-color: #0056b3;
    }

    .auth-container p {
    margin-top: 15px;
    }

    .auth-container a {
    color: #007BFF;
    text-decoration: none;
    }

    .auth-container a:hover {
    text-decoration: underline;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: url('images/vw-bg.jpg') no-repeat center center fixed; 
        background-size: cover;
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        } 
    </style>
</head>
<?php include 'header.php'; ?>

<main>
  <div class="auth-container">
    <h2>Вход</h2>
    <?php if ($registeredSuccess): ?>
      <p style="color: green;">Регистрацията беше успешна! Моля, влезте с вашите данни.</p>
    <?php endif; ?>


    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form action="" method="post">
      <input type="text" name="username" placeholder="Потребителско име" required>
      <input type="text" name="email" placeholder="Имейл" required>
      <input type="password" name="password" placeholder="Парола" required>
      <button type="submit" name="submit">Влез</button>
    </form>

    <p>Нямате акаунт? <a href="../register.php">Регистрирайте се тук</a>.</p>
  </div>
</main>

<?php include 'footer.php'; ?>
</html>

