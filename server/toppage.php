<?php

// セッション開始
session_start();

$current_user = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<?php include_once __DIR__ . '/head.html' ?> 
<body>
    <?php include_once __DIR__ . '/_header.php' ?>
    <div id="main" class="main_content">
        <div class="big_bg">
            <h2>
                Comfy<br>
                -Vintage clothing and outdoor-
            </h2>
        </div>
    </div>
    <section id="news" class="news_content wrapper">
        <h2 class="page_title">Events & News</h2>
        <div class="news_grid">
                <article>
                    <a href="">
                        <div class="news_header">
                            <div class="day">2022.04.18</div>
                            <h3>イベント出店のお知らせ</h3>
                        </div>
                    </a>
                </article>
                <article>
                    <a href="">
                        <div class="news_header">
                            <div class="day">2022.04.18</div>
                            <h3>イベント出店のお知らせ</h3>
                        </div>
                    </a>
                </article>
                <article>
                    <a href="">
                        <div class="news_header">
                            <div class="day">2022.04.18</div>
                            <h3>イベント出店のお知らせ</h3>
                        </div>
                    </a>
                </article>
                <a class="button" href="news.php">
                More
                <i class="fa-regular fa-circle-right"></i>
                </a>
        </div>
    </section>
    <section id="items" class="items_content wrapper">
        <h2 class="page_title">Items</h2>
        <div class="items_grid">
            <article class="item">
                <a href="">
                    <img src="../images/古着1.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Reebok/"LONDON WEWBLEY STADIUM 28.OCT.07"Foodie</h3>
                        4800JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着2.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>UMBRO/GLEN SHIELDS FC Practice shirt/X-Large</h3>
                        3,957JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着3.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Penfield/POLARTEC FLEECE JKT/Large/Made in USA</h3>
                        5,390JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着4.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Russell/"BOYS AND GIRLS CLUBS"Sweat/Medium</h3>
                        4,135JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着5.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>USA PLAYER SPROTSWEAR/90's Heavy weight crew"ASU"/Medium</h3>
                        4,400JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着1.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Reebok/"LONDON WEWBLEY STADIUM 28.OCT.07"Foodie</h3>
                        4800JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着2.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>UMBRO/GLEN SHIELDS FC Practice shirt/X-Large</h3>
                        3,957JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="">
                    <img src="../images/古着3.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Penfield/POLARTEC FLEECE JKT/Large/Made in USA</h3>
                        5,390JPY
                    </div>
                </a>
            </article>
        </div>
        <a class="button" href="items.php">
            More
            <i class="fa-regular fa-circle-right"></i>
        </a>
    </section>
    <section id="contact" class="contact_content wrapper">
        <h2 class="page_title">About Comfy</h2>
        <div class="about_grid">
            <div class="about">
                <h3>私たちは、文化古着を多様性の町二セコ町で広めたい思いで"Comfy"を始めました。"Comfy"とは英語で「快適な」や「居心地がいい」という意味"Comfortable"の口語系の形で、よりカジュアルな意味合いの言葉です。皆さんに当店での時間を心地よく過ごせるように、また当店の服や雑貨を身に着ける時に「ちょうど良い」と思っていただけるような想いを込めてお店の名前にさせていただきました。
                <br>イベントへの行商をメインに販売を行っております。</h3>
            </div>
            <img src="../images/comfy写真000.webp" alt="comfy背景写真">
        </div>
    </section>
    <?php include_once __DIR__ . '/_footer.html' ?>
</body>
</html>
