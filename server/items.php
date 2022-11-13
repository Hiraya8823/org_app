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
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
    <div class="items_photo">
        <img src="../images/banar2207.webp" alt="写真">
    </div>
    <h1 class="news_php_content">All Items</h1>
    <section id="items" class="items_content wrapper">
        <div class="items_grid">
            <article class="item">
                <a href="product_detail.php">
                    <img src="../images/古着1.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Reebok/"LONDON WEWBLEY STADIUM 28.OCT.07"Foodie</h3>
                        4800JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="product_detail.php">
                    <img src="../images/古着2.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>UMBRO/GLEN SHIELDS FC Practice shirt/X-Large</h3>
                        3,957JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="product_detail.php">
                    <img src="../images/古着3.webp" alt="古着写真">
                    <div class="items_header">
                        <h3>Penfield/POLARTEC FLEECE JKT/Large/Made in USA</h3>
                        5,390JPY
                    </div>
                </a>
            </article>
            <article class="item">
                <a href="product_detail.php">
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
        </div>
        <ul class="pagination">
            <li class="this">1</li>
            <li class="pagination_hover">
                <a href="">2</a>
            </li>
            <li>
                <a href="">3</a>
            </li>
            <li>
                <a href="">→</a>
            </li>
        </ul>
    </section>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
