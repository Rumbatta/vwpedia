<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>


<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <title>VWpedia</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Общ стил */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex; 
      flex-direction: column;
      background-color: #e5e5e5;
    }

    /* NAVBAR */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #000;
      padding: 10px 30px;
      color: white;
    }

    .logo-section {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 100px;
      margin-right: 10px;
    }

    .site-title {
      font-size: 20px;
      font-weight: bold;
      color: lightgray;
    }

    .search-section {
      display: flex;
      align-items: center;
    }

    .search-input {
      padding: 8px 12px;
      border-radius: 20px 0 0 20px;
      border: none;
      outline: none;
      width: 200px;
    }

    .search-btn {
      padding: 8px 16px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 0 20px 20px 0;
      cursor: pointer;
    }

    .search-btn:hover {
      background-color: darkred;
    }

    .user-section a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
    }

    .user-section a:hover {
      text-decoration: underline;
    }

    .user-icon {
      font-size: 20px;
      margin-left: 15px;
    }

    /* SECOND NAVIGATION */
    .second-nav {
      background-color: #333;
      padding: 8px 30px;
    }

    .second-nav a {
      color: white;
      margin-right: 25px;
      text-decoration: none;
      font-weight: bold;
      padding: 6px 10px;
    }

    .second-nav a:hover {
      background-color: #555;
      border-radius: 5px;
    }

      .model-dropdown {
      position: relative;
      display: inline-block;
    }

    .model-content {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #f4f4f4;
      padding: 20px;
      width: 600px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      z-index: 10;
    }

    .model-dropdown:hover .model-content {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .model-box {
      width: 120px;
      text-align: center;
      text-decoration: none;
      color: black;
    }

    .model-box img {
      width: 100%;
      border-radius: 10px;
      transition: 0.3s ease;
    }

    .model-box img:hover {
      transform: scale(1.05);
    }

    .model-name {
      margin-top: 5px;
      font-weight: bold;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      padding: 20px;
    }

    /* Footer стилове можеш да оставиш или подобриш както ти харесва */
    footer {
      background-color: #111;
      color: #ccc;
      padding: 40px 20px;
    }

    .right-section {
      display: flex;
      align-items: center;
      gap: 15px; /* разстояние между търсачката и бутоните */
    }

    .user-section {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .model-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr); /* 2 колони */
      gap: 30px;
      padding: 40px 60px;
      background-color: #f9f9f9;
    }

    .model-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 20px;
      transition: transform 0.3s ease;
    }

    .model-card:hover {
      transform: translateY(-5px);
    }

    .model-card img {
      width: 100%;
      max-width: 620px;
      max-height: 300px;
      border-radius: 8px;
    }

    .model-name {
      margin-top: 15px;
      font-size: 18px;
      font-weight: bold;
      color: #000;
    }

    .user-section form button {
      color: white;
      font-size: 16px;
      padding: 0;
      margin-left: 20px;
    }

    .user-section form button:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

  <!-- Горна навигация -->
  <header class="navbar">
    <div class="logo-section">
      <img src="/vwpedia/images/logo.png" alt="VWpedia Logo" class="logo">
      <span class="site-title">VWpedia</span>
    </div>

    <div class="right-section">
                      <div class="search-section">
                    <form action="/vwpedia/search.php" method="get" style="display: flex;">
                      <input type="text" name="q" placeholder="Търси модел..." class="search-input" required>
                      <button type="submit" class="search-btn">GO</button>
                    </form>
                  </div>

                    <div class="user-section">
                      <?php if (isset($_SESSION['user'])): ?>
                          <a href="/vwpedia/profile.php">Профил</a>
                          <?php
                            // показваме бутона за изход само ако се намираме в profile.php
                            if (basename($_SERVER['PHP_SELF']) == 'profile.php'):
                          ?>
                              <form action="logout.php" method="post" style="display:inline;">
                                <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">Изход</button>
                              </form>
                          <?php endif; ?>
                      <?php else: ?>
                          <a href="/vwpedia/login.php">Login</a>
                          <a href="/vwpedia/register.php">Register</a>
                          <span class="user-icon">👤</span>
                      <?php endif; ?>
                    </div>

                  </div>

  </header>

  <!-- Втора навигационна лента -->
  <nav class="second-nav">
  <a href="/vwpedia/index.php">НАЧАЛО</a>

  <div class="model-dropdown">
    <a href="#" class="nav-link">МОДЕЛИ</a>
    <div class="model-content">
      <a href="/vwpedia/models/golf.php" class="model-box">
        <img src="/vwpedia/images/golf.png" alt="VW Golf">
        <div class="model-name">Golf</div>
      </a>
      <a href="/vwpedia/models/passat.php" class="model-box">
        <img src="/vwpedia/images/passat.png" alt="VW Passat">
        <div class="model-name">Passat</div>
      </a>
      <a href="/vwpedia/models/tiguan.php" class="model-box">
        <img src="/vwpedia/images/tiguan.png" alt="VW Tiguan">
        <div class="model-name">Tiguan</div>
      </a>
      <a href="/vwpedia/models/touran.php" class="model-box">
        <img src="/vwpedia/images/touran.png" alt="VW Touran">
        <div class="model-name">Touran</div>
      </a>
      <a href="/vwpedia/models/touareg.php" class="model-box">
        <img src="/vwpedia/images/touareg.png" alt="VW Touareg">
        <div class="model-name">Touareg</div>
      </a>
      <a href="/vwpedia/models/polo.php" class="model-box">
        <img src="/vwpedia/images/polo.png" alt="VW Polo">
        <div class="model-name">Polo</div>
      </a>
    </div>
    </div>
  </div>

  <a href="/vwpedia/news.php">НОВИНИ</a>
  <a href="/vwpedia/about.php">ЗА НАС</a>
  
</nav>