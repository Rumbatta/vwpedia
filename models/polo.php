<?php
session_start();
include('../db_connection.php');
include('../header.php');

$model_slug = 'polo';
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
        <h1 class="title" style="text-align:center">Volkswagen Polo</h1>
        <img src="../images/polo.png" alt="VW Polo" style="width:820px; border-radius: 10px; box-shadow: 0 0 10px #000;">
        <p class="description" style="margin-top: 20px;">
            Volkswagen Polo е компактен градски автомобил, представен за пръв път през 1975 г. Отличава се със своята надеждност, икономичност и модерен дизайн, превръщайки се в един от най-популярните модели на VW.
        </p>

        <h3 style="margin-top: 30px;">Интересни факти:</h3>
        <ul class="facts">
            <li>🚗 Над 18 милиона продадени бройки по целия свят.</li>
            <li>🎯 Печелил е награди като "Автомобил на годината" в различни държави.</li>
        </ul>

        <!-- Генерации -->

        <div class="generation-box">
            <h2>Polo I (1975–1981)</h2>
            <img src="../images/polo1.jpg" alt="VW Polo I">
            <p>Първото Polo е базирано на Audi 50 и представлява компактен хечбек с икономични двигатели. Бързо се утвърждава като достъпно и надеждно градско возило.</p>
        </div>

        <div class="generation-box">
            <h2>Polo II (1981–1994)</h2>
            <img src="../images/polo2.jpg" alt="VW Polo II">
            <p>Втората генерация се предлага и с уникалния за времето си "breadvan" дизайн. Подобрена е икономията, безопасността и практичността.</p>
        </div>

        <div class="generation-box">
            <h2>Polo III (1994–2001)</h2>
            <img src="../images/polo3.jpg" alt="VW Polo III">
            <p>По-модерен дизайн и по-добро оборудване. Включва и спортната версия Polo GTI, която добавя динамика към ежедневното шофиране.</p>
        </div>

        <div class="generation-box">
            <h2>Polo IV (2001–2009)</h2>
            <img src="../images/polo4.jpg" alt="VW Polo IV">
            <p>Повече технологии, по-голям комфорт и нови TDI дизелови двигатели. Отлично представяне в краш тестовете.</p>
        </div>

        <div class="generation-box">
            <h2>Polo V (2009–2017)</h2>
            <img src="../images/polo5.jpg" alt="VW Polo V">
            <p>Носител на титлата "Автомобил на годината в Европа" през 2010 г. Включва модерни системи за безопасност и икономични мотори.</p>
        </div>

        <div class="generation-box">
            <h2>Polo VI (2017 – днес)</h2>
            <img src="../images/polo6.jpg" alt="VW Polo VI">
            <p>Изграден на MQB платформата, Polo VI предлага дигитален кокпит, LED фарове и най-високо ниво на комфорт в историята на модела.</p>
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
