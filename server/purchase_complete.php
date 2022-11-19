<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
$user_id = '';
$products_cart = '';
$products_carts = '';
$product_cart = '';
$total_price = 0;
$price_sum = '';
$product_cart_price = [];

$errors = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

$user_id = $current_user['id'];



?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
    <div id="product_carts" class="product_carts">
        <div class="box">
            <h1 class="left wrapper">
                Your Cart
            </h1>
            <div class="right">
                    <div class="cart_empty">
                        <h1>ご注文ありがとうございます。</h1>
                    </div>
                    <a href="/" class="cart_back_btn">Back</a>

            </div>
        </div>
    </div>
</body>

</html>
