<?php
session_start();
include('../db_connection.php');
include('../header.php');

$model_slug = 'passat';
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
        <h1 class="title" style="text-align:center">Volkswagen Passat</h1>
        <img src="../images/passat.png" alt="VW Passat" style="width:820px; border-radius: 10px; box-shadow: 0 0 10px #000;">
        <p class="description" style="margin-top: 20px;">
            Volkswagen Passat е средноразмерен автомобил, пуснат на пазара през 1973 г. Отличава се със стил, комфорт и надеждност, и е популярен както сред семейства, така и за бизнес.
        </p>

        <h3 style="margin-top: 30px;">Интересни факти:</h3>
        <ul class="facts">
            <li>🚗 Passat е продаден в над 30 милиона броя в световен мащаб.</li>
            <li>🏆 Моделът е печелил много награди за безопасност и комфорт.</li>
        </ul>

        <!-- Генерации -->

        <div class="generation-box">
            <h2>Passat B1 (1973–1981)</h2>
            <img src="../images/passat1.jpg" alt="VW Passat B1">
            <p>Първият Passat използва платформа от Audi 80 и предлага практична комбинация от седан и комби с предно предаване – революционно за времето си.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B2 (1981–1988)</h2>
            <img src="../images/passat2.jpg" alt="VW Passat B2">
            <p>По-голям и по-ъгловат дизайн. Предлага се и с 4х4 система Syncro и дизелови опции. В Китай се продава като Santana и днес.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B3 (1988–1993)</h2>
            <img src="../images/passat3.jpg" alt="VW Passat B3">
            <p>Първият Passat с напречно монтиран двигател. Без традиционна предна решетка – по-гладък и аеродинамичен дизайн. Нови технологии като ABS.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B4 (1993–1996)</h2>
            <img src="../images/passat4.jpg" alt="VW Passat B4">
            <p>Фейслифт на B3 с по-модерен вид, подобрена безопасност и по-луксозен интериор. Започват да се използват по-ефективни двигатели.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B5 / B5.5 (1996–2005)</h2>
            <img src="../images/passat5.jpg" alt="VW Passat B5">
            <p>Изграден на платформата на Audi A4. 4Motion задвижване, автоматична климатизация, ксенонови фарове. Луксозно усещане за среден клас.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B6 (2005–2010)</h2>
            <img src="../images/passat6.jpg" alt="VW Passat B6">
            <p>Съвременен външен вид, нови TSI и TDI двигатели, електрическа ръчна спирачка, DSG скоростна кутия. Отлична стабилност и комфорт.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B7 (2010–2014)</h2>
            <img src="../images/passat7.jpg" alt="VW Passat B7">
            <p>Рафинирана версия на B6 с подобрения в интериора, безопасността и инфоразвлекателните системи. Създаден за по-зрели клиенти.</p>
        </div>

        <div class="generation-box">
            <h2>Passat B8 (2014 – днес)</h2>
            <img src="../images/passat8.jpg" alt="VW Passat B8">
            <p>Изграден върху MQB платформа, включва хибридни версии (GTE), дигитален кокпит, матрични фарове и системи за автономно шофиране.</p>
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
