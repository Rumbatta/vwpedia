<!-- footer.php -->
<style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
}

/* Footer */
.footer {
  background-color: #222;
  color: #ccc;
  text-align: center;
  padding: 20px;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<footer style="background-color: #111; color: #ccc; padding: 40px 20px; font-family: Arial, sans-serif;">
  <div style="display: flex; justify-content: space-around; flex-wrap: wrap; max-width: 1200px; margin: auto;">
    
    <!-- VWpedia инфо -->
    <div style="flex: 1; min-width: 200px; margin: 10px;">
      <h3 style="color: white;">VWpedia</h3>
      <p>Проект по "Проектни и творчески дейности". Тук ще откриете информация за всички модели на Volkswagen.</p>
    </div>

    <!-- Бързи връзки -->
    <div style="flex: 1; min-width: 200px; margin: 10px;">
      <h4 style="color: white;">Бързи връзки</h4>
      <ul style="list-style: none; padding-left: 0;">
        <li><a href="/vwpedia/index.php" style="color: #ccc; text-decoration: none;">Начало</a></li>
        <li><a href="/vwpedia/login.php" style="color: #ccc; text-decoration: none;">Вход</a></li>
        <li><a href="/vwpedia/register.php" style="color: #ccc; text-decoration: none;">Регистрация</a></li>
      </ul>
    </div>

    <!-- Социални мрежи -->
    <div style="flex: 1; min-width: 200px; margin: 10px;">
      <h4 style="color: white;">Последвай ни</h4>
      <div style="font-size: 20px;">
        <a href="https://www.facebook.com" style="color: #ccc; margin-right: 10px;"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com" style="color: #ccc; margin-right: 10px;"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com" style="color: #ccc; margin-right: 10px;"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <hr style="margin: 20px auto; width: 90%; border-color: #333;">
  <p style="text-align: center; color: #777;">&copy; 2025 VWpedia. Всички права запазени.</p>
</footer>
</body>
</html>
