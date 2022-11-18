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


// ユーザーIDからproductIDを取得
$products_cart = find_product_id_by_user_id($user_id);

$product_cart_price = find_product_price_by_user_id($user_id);


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
                <?php if (!empty($products_cart)) : ?>
                    <?php foreach ($products_cart as $product_cart) : ?>
                        <div class="product_cart">
                            <div class="product_cart_img">
                                <img src="../images/<?= h($product_cart['image']) ?>" alt="">
                            </div>
                            <div class="product_cart_detail">
                                <div class="product_name">
                                    <p><?= h($product_cart['name']) ?></p>
                                    <a href="cart_delete.php?id=<?= h($product_cart['id']) ?>" class="product_cart_delete"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                                <h2 class="product_price">
                                    <?= h($product_cart['price']) ?> JPY
                                </h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="total_price">
                        <h1>Subtotal</h1>
                        <h1><?= $product_cart_price['total_price'] ?> JPY</h1>
                    </div>
                    <p>Tax included and shipping calculated at checkout.</p>
                    <div class="row_right">
                        <a href="items.php" class="continue_shopping_btn">Continue shopping</a>
                        <a href="purchase.php" class="check_out_btn">Check out</a>
                    </div>
                <?php else : ?>
                    <h1>Your cart is currently empty.</h1>
                    <a href="items.php">戻る</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <pre><?php var_dump($product_cart_price); ?></pre>
</body>

</html>
