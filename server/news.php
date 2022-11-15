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
    <div class="news_container">
        <div class="items_photo">
            <img src="../images/48987212_.jpeg" alt="写真">
        </div>
        <h1 class="news_php_content">Events & News</h1>
        <div class="news_php_grid">
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
                    </div>
                </a>
            </article>
            <article class="news_php">
                <a href="">
                    <div class="news_photo">
                        <img src="../images/_1664343445.webp" alt="ニュース画像">
                    </div>
                    <div class="news_php_header">
                        <h3>10月のイベント出店のお知らせ</h3>
                    </div>
                    <div class="news_day">
                        2022.10.31
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
    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
