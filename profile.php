<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Профил</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }
        .profile-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .profile-box h2 {
            margin-bottom: 20px;
        }
        .profile-info {
            text-align: left;
            margin-bottom: 30px;
        }
        .profile-info p {
            margin-bottom: 10px;
        }
        .logout-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
        .edit-btn {
        display: inline-block;
        margin-top: 10px;
        background: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 16px;
        }

        .edit-btn:hover {
        background: #0056b3;
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
<body>

<?php include 'header.php'; ?>

<main>
    <div class="profile-box">
        <h2>Добре дошъл, <?= htmlspecialchars($user['username']) ?>!</h2>
        <div class="profile-info">
            <p><strong>Потребителско име:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>
        <form method="post" action="logout.php">
            <button type="submit" class="logout-btn">Изход</button>
            <a href="edit_profile.php" class="edit-btn">Редактирай профил</a>

        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
