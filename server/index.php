<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
$news_notdelete = '';
$news_notdelete_reverse = '';
$news = '';
$products_notdelete = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

$news_notdelete = find_news_by_admin_order_limit(NEWS_NOTDELETE);
$products_notdelete = find_products_by_done_order_limit(NEWS_NOTDELETE)

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
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

            <?php foreach ($news_notdelete as $news) : ?>
                <article>
                    <a href="news_detail.php?id=<?= h($news['id']) ?>">
                        <div class="news_header">
                            <div class="day"><?= h($news['created_at']) ?></div>
                            <h3><?= h($news['name']) ?></h3>
                        </div>
                    </a>
                </article>

            <?php endforeach; ?>
            <a class="button" href="news.php">
                More
                <i class="fa-regular fa-circle-right"></i>
            </a>
        </div>
    </section>
    <section id="items" class="items_content wrapper">
        <h2 class="page_title">Items</h2>
        <div class="items_grid">
            <?php foreach ($products_notdelete as $product_notdelete) : ?>
                <article class="item">
                    <a href="product_detail.php?id=<?= h($product_notdelete['id']) ?>">
                        <img src="/images/<?= h($product_notdelete['image']) ?>" alt="古着写真">
                        <div class="items_header">
                            <h3><?= h($product_notdelete['name']) ?></h3>
                            <p><?= h($product_notdelete['price']) ?>  JPY</p>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
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
                    <br>イベントへの行商をメインに古着の販売を行っております。
                </h3>
            </div>
            <img src="/../images/comfy写真000.webp" alt="comfy背景写真">
        </div>
    </section>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
