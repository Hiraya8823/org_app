<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';
require_once __DIR__ . '/common/config.php';

// セッション開始
session_start();

$current_user = '';
$products_notdelete = '';
$product_notdelete_reverse = '';
$product_notdelete_reverse = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}


// 商品の取得
$products_notdelete = find_prpduct_by_done(NEWS_NOTDELETE);
$product_notdelete_reverse = array_reverse($products_notdelete);
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
            <?php foreach ($product_notdelete_reverse as $product_notdelete) : ?>
                <article class="item">
                    <a href="product_detail.php?id=<?= h($product_notdelete['id']) ?>">
                        <img src="../images/<?= h($product_notdelete['image']) ?>" alt="古着写真">
                        <div class="items_header">
                            <h3><?= h($product_notdelete['name']) ?></h3>
                            <p><?= h($product_notdelete['price']) ?>  JPY</p>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
