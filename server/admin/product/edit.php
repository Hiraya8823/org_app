<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';


// セッション開始
session_start();

$current_user = '';
$errors = [];
$products_db = [];
$id = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// 受け取った id のレコードを取得
$products_db = find_product_by_id($id);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = filter_input(INPUT_POST, 'product_name');
    $price = filter_input(INPUT_POST, 'price');
    $product_detil = filter_input(INPUT_POST, 'product_detil');
    
    // バリデーション
    $errors = update_products_validate($product_name, $price, $product_detil);


    // エラーチェック
    if (empty($errors)) {

        update_produccts($id, $product_name, $price, $product_detil);
        // index.php にリダイレクト
        header('Location: product_list.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../../common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/../../common/_header.php' ?>

    <div class="news_new_content">
        <h2 class="news_new_title">商品変更</h2>
        <?php if (!empty($errors)) : ?>
            <ul class="errors">
                <?php foreach ($errors as $error) : ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form class="news_new_form" action="" method="post" enctype="multipart/form-data">
            <img src="../../images/<?= h($products_db['image']) ?>">
            <label class="title_label" for="product_name">商品名</label>
            <input type="text" name="product_name" id="product_name" placeholder="Product name" value="<?= h($products_db['name']) ?>">
            <label class="title_label" for="price">価格</label>
            <input type="text" name="price" id="price" placeholder="Price" value="<?= h($products_db['price']) ?>">
            <label class="news_label" for="product_detil">商品説明</label>
            <textarea class="input_text" name="product_detil" id="product_detil" rows="5" placeholder=""><?= h($products_db['explanation']) ?></textarea>
            <div class="button_area">
                <a href="product_list.php" class="login_page_button">戻る</a>
                <input type="submit" value="登録" class="signup_button">
            </div>
        </form>

    </div>

    <?php include_once __DIR__ . '/../../common/_footer.php' ?>
</body>

</html>
