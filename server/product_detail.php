<?php
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
$id = '';
$products_db = '';
$user_id = '';

$errors = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
    $user_id = $current_user['id'];
}


// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// 受け取った id のレコードを取得
$products_db = find_product_by_id($id);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($products_db['done'] == 0) {
        insert_product_cart($id, $user_id);
        header('Location: product_cart.php');
        exit;
    } else {
        $errors[] = MSG_PRODUCT_SOLDOUT;
    }
}

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
            <?php include_once __DIR__ . '/common/_errors.php' ?>
            <h1 class="product_name">
                <?= h($products_db['name']) ?>
            </h1>
            <h2 class="product_detail_price">
                <?= h($products_db['price']) ?>JPY
            </h2>
            <?php if (!empty($current_user)) : ?>
                <form action="" method="post">
                    <input type="submit" class="submit_btn" value="Add to cart">
                </form>
            <?php else : ?>
                <a href="login.php" class="submit_btn_a">Add to cart</a>
            <?php endif; ?>
            <p class="textarea_p">
                <?= h($products_db['explanation']) ?>
            </p>
        </div>
    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
