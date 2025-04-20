<?php
$models = [
    'Golf' => 'models/golf.php',
    'Passat' => 'models/passat.php',
    'Tiguan' => 'models/tiguan.php',
    'Touran' => 'models/touran.php',
    'Touareg' => 'models/touareg.php',
    // Добави тук и другите модели
];

$query = strtolower($_GET['q'] ?? '');
$results = [];

if ($query !== '') {
    foreach ($models as $model => $link) {
        if (strpos(strtolower($model), $query) !== false) {
            $results[$model] = $link;
        }
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <title>Резултати от търсене | VWpedia</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('images/blur-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
    }

    .search-results {
      max-width: 800px;
      margin: 80px auto;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .search-results h2 {
      text-align: center;
      color: #003366;
      margin-bottom: 30px;
    }

    .search-results ul {
      list-style: none;
      padding: 0;
    }

    .search-results li {
      margin: 15px 0;
      padding: 12px 20px;
      background: #f5f5f5;
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }

    .search-results li:hover {
      background-color: #e0e0e0;
    }

    .search-results a {
      text-decoration: none;
      color: #003366;
      font-weight: bold;
      font-size: 18px;
    }

    .search-results a:hover {
      text-decoration: underline;
    }

    .search-results p {
      text-align: center;
      font-size: 18px;
      color: #777;
      margin-top: 20px;
    }

    .back-btn {
      display: block;
      width: fit-content;
      margin: 30px auto 0;
      padding: 10px 20px;
      background-color:rgb(22, 108, 194);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .back-btn:hover {
      background-color: #0055aa;
    }
  </style>
</head>
<body>

<main class="search-results">
    <h2>Резултати от търсене за: "<?= htmlspecialchars($query) ?>"</h2>

    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $model => $link): ?>
                <li><a href="<?= $link ?>"><?= htmlspecialchars($model) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Няма намерени модели.</p>
    <?php endif; ?>

    <a href="index.php" class="back-btn">⬅ Назад към началото</a>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
