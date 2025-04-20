<?php
session_start();
include('../db_connection.php');
include('../header.php');

$model_slug = 'touran';
$isLoggedIn = isset($_SESSION['user_id']);
$hasVoted = false;

if ($isLoggedIn) {
    $stmt = $connection->prepare("SELECT vote FROM model_votes WHERE user_id = :user_id AND model_slug = :model_slug");
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':model_slug' => $model_slug
    ]);
    $hasVoted = $stmt->rowCount() > 0;
}
?>

<style>
html, body {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
    background: url('../images/vw-bg.jpg') center/cover fixed no-repeat;
    color: #1a1a1a;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 60px 20px;
}

.blur-box {
    max-width: 900px;
    width: 100%;
    padding: 40px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.generation-box {
    margin-top: 40px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.generation-box h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #005f73;
}

.generation-box p {
    font-size: 16px;
    margin-bottom: 10px;
    line-height: 1.6;
}

.generation-box img {
    width: 100%;
    max-width: 500px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px #00000020;
}

.facts li {
    margin: 8px 0;
}

.back-button {
    display: inline-block;
    margin-top: 20px;
    color: #005f73;
    text-decoration: none;
    font-weight: bold;
}

.vote-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    margin-right: 10px;
    cursor: pointer;
    font-weight: bold;
}
.vote-btn.yes {
    background-color: #2ecc71;
    color: white;
}
.vote-btn.no {
    background-color: #e74c3c;
    color: white;
}
</style>

<body>
<main>
    <div class="blur-box">
        <h1 class="title" style="text-align:center">Volkswagen Touran</h1>
        <img src="../images/touran.png" alt="VW Touran" style="width:820px; border-radius: 10px; box-shadow: 0 0 10px #000;">
        <p class="description" style="margin-top: 20px;">
            Volkswagen Touran е компактен миниван, създаден за семейства и хора с активен начин на живот. Съчетава удобство, безопасност и икономични двигатели. Известен е със своето просторно купе и модулни седалки.
        </p>

        <h3 style="margin-top: 30px;">Интересни факти:</h3>
        <ul class="facts">
            <li>👨‍👩‍👧‍👦 Предлага се с до 7 места.</li>
            <li>🔧 Touran е построен върху платформата на Golf.</li>
        </ul>

        <!-- Генерации -->

        <div class="generation-box">
            <h2>Touran I (2003–2015)</h2>
            <img src="../images/touran1.jpg" alt="VW Touran I">
            <p>Първият Touran използва PQ35 платформата, позната от Golf V. Предлага се с широка гама бензинови и дизелови двигатели и гъвкаво вътрешно пространство. През 2010 г. получава фейслифт с LED светлини и ново табло.</p>
        </div>

        <div class="generation-box">
            <h2>Touran II (2015 – днес)</h2>
            <img src="../images/touran2.jpg" alt="VW Touran II">
            <p>Новият Touran е базиран на MQB платформата, с по-ниско тегло и по-добра икономия. Вътрешността е технологично напреднала – с мултимедиен дисплей, адаптивен круиз контрол и асистенти за паркиране. Просторен и удобен за дълги пътувания.</p>
        </div>

        <!-- Назад -->
        <a class="back-button" href="/vwpedia/index.php">⬅ Назад към началото</a>

        <!-- Гласуване -->
        <div class="vote-section" style="margin-top: 40px; padding: 20px; background: rgba(255,255,255,0.3); border-radius: 10px;">
            <h3>Харесваш ли този модел?</h3>
            <?php if ($isLoggedIn): ?>
                <?php if (!$hasVoted): ?>
                    <form method="post" action="../vote.php">
                        <input type="hidden" name="model_slug" value="<?= htmlspecialchars($model_slug) ?>">
                        <button type="submit" name="vote" value="yes" class="vote-btn yes">✅ Да</button>
                        <button type="submit" name="vote" value="no" class="vote-btn no">❌ Не</button>
                    </form>
                <?php else: ?>
                    <p style="color: green;">Вече сте гласували за този модел.</p>
                <?php endif; ?>
            <?php else: ?>
                <p style="color: red;">Само регистрирани потребители могат да гласуват.</p>
            <?php endif; ?>

            <?php
            $stmt = $connection->prepare("SELECT vote, COUNT(*) as total FROM model_votes WHERE model_slug = :model_slug GROUP BY vote");
            $stmt->execute([':model_slug' => $model_slug]);
            $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $yesVotes = 0;
            $noVotes = 0;
            foreach ($votes as $row) {
                if ($row['vote'] === 'yes') $yesVotes = $row['total'];
                if ($row['vote'] === 'no') $noVotes = $row['total'];
            }
            ?>

            <div style="margin-top: 20px;">
                <p>👍 Харесали: <?= $yesVotes ?></p>
                <p>👎 Не харесали: <?= $noVotes ?></p>
            </div>
        </div>
    </div>
</main>

<?php include('../footer.php'); ?>
</body>
</html>
