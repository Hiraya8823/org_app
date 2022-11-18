<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
$id = '';
$products_cart = '';
$products_carts = '';
$product_cart = '';
$total_price = 0;
$price_sum = '';
$product_cart_price = '';

$errors = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

$id = $current_user['id'];


$user = find_user_by_id($id);


// ユーザーIDからproductIDを取得
$products_cart = find_product_id_by_user_id($id);

$product_cart_price = find_product_price_by_user_id($id);


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
                        <h1> JPY</h1>
                    </div>
                    <p>Tax included and shipping calculated at checkout.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="box">
            <h1 class="left wrapper">
                Your Cart
            </h1>
            <div class="right">
                
                <?php include_once __DIR__ . '/common/_errors.php' ?>
                <form class="signup_form" action="" method="post">
                    <label class="email_label" for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= h($user['email']) ?>">
                    <label class="name_label" for="name">名前</label>
                    <input type="text" name="name" id="name" placeholder="UserName" value="<?= h($user['name']) ?>">
                    <label class="name_label" for="name">ふりがな</label>
                    <input type="text" name="name" id="name" placeholder="UserName" value="<?= h($user['name']) ?>">
                    <label class="password_label" for="post_code">郵便番号</label>
                    <input type="text" name="post_code" id="post_code" placeholder="Post_code" value="<?= h($user['post_code']) ?>">
                    <label class="password_label" for="address">住所</label>
                    <input type="text" name="address" id="address" placeholder="Address" value="<?= h($user['address']) ?>">
                    <label class="password_label" for="phone_number">電話番号</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Phone_number" value="<?= h($user['phone_number']) ?>">
                    <div class="button_area">
                        <input type="submit" value="登録" class="signup_button">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
