<?php
session_start();
include('../db_connection.php');
include('../header.php');

$model_slug = 'touareg';
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
        <h1 class="title" style="text-align:center">Volkswagen Touareg</h1>
        <img src="../images/touareg.png" alt="VW Touareg" style="width:820px; border-radius: 10px; box-shadow: 0 0 10px #000;">
        <p class="description" style="margin-top: 20px;">
            Volkswagen Touareg е луксозен SUV, съчетаващ изискан дизайн, модерни технологии и отлична проходимост. Разработен съвместно с Porsche и Audi, Touareg се позиционира като премиум алтернатива в SUV сегмента.
        </p>

        <h3 style="margin-top: 30px;">Интересни факти:</h3>
        <ul class="facts">
            <li>🏔️ Touareg може да тегли над 3.5 тона – идеален за ремаркета и каравани.</li>
            <li>🚗 Има версии с V10 TDI двигател – един от най-мощните дизели в лек автомобил.</li>
        </ul>

        <!-- Генерации -->

        <div class="generation-box">
            <h2>Touareg I (2002–2010)</h2>
            <img src="../images/touareg1.jpg" alt="VW Touareg I">
            <p>Първият Touareg бе революция за Volkswagen – с постоянно задвижване на четирите колела, опция за въздушно окачване и множество мощни бензинови и дизелови двигатели. Изграден е на платформа, споделена с Porsche Cayenne.</p>
        </div>

        <div class="generation-box">
            <h2>Touareg II (2010–2018)</h2>
            <img src="../images/touareg2.jpg" alt="VW Touareg II">
            <p>По-лек и по-икономичен от предшественика си, с по-елегантен дизайн. Въведени са нови технологии като хибридна версия и подобрена мултимедия. Отново с възможност за офроуд приключения.</p>
        </div>

        <div class="generation-box">
            <h2>Touareg III (2018 – днес)</h2>
            <img src="../images/touareg3.jpg" alt="VW Touareg III">
            <p>Текущото поколение използва MLB платформата на групата VW и е технологично най-напредналото. С огромен „Innovision Cockpit“, дигитално табло, 4-зонов климатик и всички съвременни асистенти за шофиране.</p>
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
