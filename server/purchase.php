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
$purchase_history_id = '';

$errors = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

$id = $current_user['id'];
$user = find_user_by_id($id);

// ユーザーIDからproductIDを取得
$products_cart = find_product_id_by_user_id($id);
$product_cart_price = find_product_price_by_user_id($id);
$total_price = $product_cart_price['total_price'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $name = filter_input(INPUT_POST, 'name');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $phone_number = filter_input(INPUT_POST, 'phone_number');
    // バリデーション
    $errors = update_validate($email, $name, $post_code, $address, $phone_number, $current_user);


    // エラーチェック
    if (empty($errors)) {
        delete_carts_by_id($id);
        $purchase_history_id = insert_purchase_histories($id, $total_price);
        insert_payments($purchase_history_id, $email, $name, $post_code, $address, $phone_number);
        }
        
        
        // index.php にリダイレクト
        header('Location: index.php');
        exit;
    
}



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
                <?php endif; ?>
            </div>
        </div>

        <div class="box purchase_content">
            <h1 class="left wrapper">
                Payment
            </h1>
            <div class="right">
                <p>※送料は一律1500円になります。</p>
                <p>※発送はご注文受付後一週間前後となります。</p>
                <p>※現在着払いでのご注文のみの受付となります。</p>
                <?php include_once __DIR__ . '/common/_errors.php' ?>
                <form class="signup_form purchase_form" action="" method="post">
                    <label class="email_label" for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= h($user['email']) ?>">
                    <label class="name_label" for="name">名前</label>
                    <input type="text" name="name" id="name" placeholder="UserName" value="<?= h($user['name']) ?>">
                    <label class="password_label" for="post_code">郵便番号</label>
                    <input type="text" name="post_code" id="post_code" placeholder="Post_code" value="<?= h($user['post_code']) ?>">
                    <label class="password_label" for="address">住所</label>
                    <input type="text" name="address" id="address" placeholder="Address" value="<?= h($user['address']) ?>">
                    <label class="password_label" for="phone_number">電話番号</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Phone_number" value="<?= h($user['phone_number']) ?>">
                    <div class="button_area">
                        <input type="submit" value="Purchase" class="purchase_signup_button">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
