<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "vwpedia";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Вмъкване в базата
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->execute([$username, $email, $password]);

  // Пренасочване към login страницата след успешна регистрация
  header("Location: login.php?registered=1");
  exit;

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
    <h2>Регистрация</h2>

    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p style='color: green;'>$success</p>"; ?>

    <form action="" method="post">
      <input type="text" name="username" placeholder="Потребителско име" required>
      <input type="email" name="email" placeholder="Имейл" required>
      <input type="password" name="password" placeholder="Парола" required>
      <button type="submit" name="submit">Регистрирай се</button>
    </form>

    <p>Вече имате акаунт? <a href="login.php">Влезте тук</a>.</p>
  </div>
</main>

<?php include 'footer.php'; ?>
</html>
