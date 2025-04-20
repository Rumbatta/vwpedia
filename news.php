
<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <title>VWpedia</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .news-page {
    padding: 20px 40px;
    background-color: #f9f9f9;
    }

    .news-item {
    background-color: #fff;
    border-left: 5px solid #007BFF;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .news-item h3 {
    margin-bottom: 10px;
    color: #007BFF;
    }

    .news-item p {
    margin-bottom: 10px;
    line-height: 1.6;
    }

    .news-item a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
    }

    .news-item a:hover {
    text-decoration: underline;
    }

    .read-more-btn {
    display: inline-block;
    margin-top: 10px;
    background-color: #007BFF;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
    }

    .read-more-btn:hover {
    background-color: #0056b3;
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

<main style="padding: 40px; background-color: #f4f4f4;">
  <h1 style="text-align: center; margin-bottom: 40px;">Актуални новини от Volkswagen</h1>

  <div style="display: grid; gap: 30px;">
    <!-- НОВИНА 1 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>Volkswagen представя новия електрически ID.7</h2>
      <p style="color: gray; font-size: 14px;">Април 2025</p>
      <p>Volkswagen официално представи ID.7 – нов флагман в семейството на електрическите модели. С пробег над 600 км и луксозни технологии, той е насочен към дългите пътувания и бизнес потребители.</p>
      <a href="https://www.volkswagen.bg/id7/id7" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 2 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>Golf 8 получава фейслифт и нов софтуер</h2>
      <p style="color: gray; font-size: 14px;">Март 2025</p>
      <p>Любимецът на Европа – VW Golf, получи обновен дизайн и нова информационно-развлекателна система с поддръжка на AI асистент. Вариантите GTI и R също бяха подобрени.</p>
      <a href="https://autobild.bg/vw-показа-първи-тийзър-на-фейслифта-на-golf-8/" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 3 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>Volkswagen инвестира в нова електрическа фабрика в Германия</h2>
      <p style="color: gray; font-size: 14px;">Февруари 2025</p>
      <p>Компанията инвестира над 2 милиарда евро в строителството на нова производствена база, посветена изцяло на електрически превозни средства, като част от своята стратегия за устойчива мобилност.</p>
      <a href="https://forbesbulgaria.com/2025/01/22/volkswagen-tarsi-nova-era-v-germaniya-sas-stari-pohvati/" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 4 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>VW обяви партньорство с Bosch за автономно шофиране</h2>
      <p style="color: gray; font-size: 14px;">Януари 2025</p>
      <p>Volkswagen и Bosch си партнират за разработване на автономни технологии за следващото поколение ID модели. Очаква се първите системи да бъдат внедрени до 2026 г.</p>
      <a href="https://money.bg/about/volkswagen?page=6" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 5 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>VW Arteon спира производството – заменя се с електрически модел</h2>
      <p style="color: gray; font-size: 14px;">Декември 2024</p>
      <p>Volkswagen спира производството на луксозния Arteon, за да освободи място за нов електрически седан в ID семейството. Новият модел ще комбинира спортен дизайн и екологични технологии.</p>
      <a href="https://automedia.investor.bg/a/2-novini/56177-volkswagen-priklyuchi-sas-sedana-arteon" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 6 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>Volkswagen започва тестове на водородно задвижване</h2>
      <p style="color: gray; font-size: 14px;">Ноември 2024</p>
      <p>Германският производител тества нова система на водородна горивна клетка, като част от проучванията за алтернативни горива. Първите резултати се очакват до края на 2025 г.</p>
      <a href="https://www.volkswagen.bg/elektricheski-i-hibridni-avtomobili/ekologichna-ustoichivost/way-to-zero-nashiyat-pt-km-klimatichna-neutralnost" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 7 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>VW ID.Buzz се превръща в хит на американския пазар</h2>
      <p style="color: gray; font-size: 14px;">Октомври 2024</p>
      <p>Ретро-микробусът ID.Buzz съчетава стил от миналото с електрическо бъдеще. С над 20,000 предварителни поръчки, моделът се очертава като нова икона на марката.</p>
      <a href="https://autobild.bg/американска-компания-превръща-елект/" class="read-more-btn">Прочети повече</a>
    </article>

    <!-- НОВИНА 8 -->
    <article style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
      <h2>Volkswagen пуска мобилно приложение за диагностика</h2>
      <p style="color: gray; font-size: 14px;">Септември 2024</p>
      <p>Новото приложение VW Connect ще позволява на потребителите да следят състоянието на автомобила си в реално време, включително нива на масло, акумулатор и други.</p>
      <a href="https://www.volkswagen.bg/svrzanost-i-uslugi-za-mobilnost/svrzanost/we-connect-go" class="read-more-btn">Прочети повече</a>
    </article>
  </div>
</main>

<?php include 'footer.php'; ?>




