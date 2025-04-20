<?php
session_start();
include('../db_connection.php');
include('../header.php');

$model_slug = 'golf';
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
        <h1 class="title" style="text-align:center">Volkswagen Golf</h1>
        <img src="../images/golf.png" alt="VW Golf" style="width:820px; border-radius: 10px; box-shadow: 0 0 10px #000; ">
        <p class="description" style="margin-top: 20px;">
            Volkswagen Golf е един от най-популярните модели на марката, произвеждан от 1974 г. досега.
            Познат със своята икономичност, надеждност и компактен дизайн.
        </p>

        <h3 style="margin-top: 30px;">Интересни факти:</h3>
        <ul class="facts">
            <li>🚗 Golf е най-продаваният модел на VW за всички времена.</li>
            <li>🔥 Golf GTI е сред най-емблематичните хечбеци в света.</li>
        </ul>

        <!-- Генерации -->
        
        <!-- Генерации -->
        <div class="generation-box">
            <h2>Golf I (1974–1983)</h2>
            <img src="../images/golf1.jpg" alt="VW Golf I">
            <p>Първото поколение Golf заменя VW Beetle и бележи началото на нова ера. Предлага се с различни двигатели, включително легендарния GTI (1976).</p>
        </div>

        <div class="generation-box">
            <h2>Golf II (1983–1991)</h2>
            <img src="../images/golf2.jpg" alt="VW Golf II">
            <p>Golf II запазва духа на първия, но добавя технологии като ABS и електронни екстри. GTI версията продължава да е сред фаворитите.</p>
        </div>

        <div class="generation-box">
            <h2>Golf III (1991–1997)</h2>
            <img src="../images/golf3.jpg" alt="VW Golf III">
            <p>По-заоблен дизайн, по-добра безопасност и въвеждане на TDI дизел. Golf III е първият с въздушна възглавница.</p>
        </div>

        <div class="generation-box">
            <h2>Golf IV (1997–2003)</h2>
            <img src="../images/golf4.jpg" alt="VW Golf IV">
            <p>Елегантен стил, по-добро окачване и премиера на Golf R32 с 4x4 система и V6 двигател. Интериорът вече изглежда премиум.</p>
        </div>

        <div class="generation-box">
            <h2>Golf V (2003–2008)</h2>
            <img src="../images/golf5.jpg" alt="VW Golf V">
            <p>По-голям, по-комфортен, с подобрена динамика и нови двигатели (TSI, DSG трансмисия). GTI отново впечатлява феновете.</p>
        </div>

        <div class="generation-box">
            <h2>Golf VI (2008–2012)</h2>
            <img src="../images/golf6.jpg" alt="VW Golf VI">
            <p>Фейслифт на Golf V, с подобрен комфорт, безопасност и екологичност. Предлагат се и GTI, GTD, R версии.</p>
        </div>

        <div class="generation-box">
            <h2>Golf VII (2012–2019)</h2>
            <img src="../images/golf7.jpg" alt="VW Golf VII">
            <p>Изграден върху MQB платформа, дигитализиран интериор, икономични двигатели, версии като GTE (plug-in хибрид), GTI и R.</p>
        </div>

        <div class="generation-box">
            <h2>Golf VIII (2019 – днес)</h2>
            <img src="../images/golf8.jpg" alt="VW Golf VIII">
            <p>Модерна визия, тъчконтроли, дигитален кокпит, хибридни варианти, версии GTI, GTE и GTD. Най-смарт Golf досега.</p>
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
