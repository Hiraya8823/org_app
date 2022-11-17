<?php
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
$id = '';
$products_db = '';


if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// 受け取った id のレコードを取得
$products_db = find_product_by_id($id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
    <div class="product_detail_content">
        <div class="product_img">
            <img src="/images/<?= h($products_db['image']) ?>" alt="古着写真">
        </div>
        <div class="product_detail">
            <h1 class="product_name">
                <?= h($products_db['name']) ?>
            </h1>
            <h2 class="product_detail_price">
                <?= h($products_db['price']) ?>JPY
            </h2>
            <input type="submit" class="submit_btn" value="Add to cart">
            <p class="textarea_p">
            <?= h($products_db['explanation']) ?>
            </p>
        </div>
    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
