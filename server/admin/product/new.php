<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';

// セッション開始
session_start();

$current_user = '';
$product_name = '';
$price = '';
$product_detil = '';
$upload_file = '';
$upload_tmp_file = '';
$errors = [];
$image_name = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 画像の説明文とタイトル
    $product_name = filter_input(INPUT_POST, 'product_name');
    $price = filter_input(INPUT_POST, 'price');
    $product_detil = filter_input(INPUT_POST, 'product_detil');
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    $errors = insert_validate_product($upload_file, $product_name, $price, $product_detil);

    if (empty($errors)) {
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../../images/' . $image_name;

        if (move_uploaded_file($upload_tmp_file, $path)) {
            insert_product($image_name, $product_name, $price, $product_detil);
            header('Location: /');
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../../common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/../../common/_header.php' ?>

    <div class="news_new_content">
        <h2 class="news_new_title">商品登録</h2>
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
            <label class="upload_content_label" for="file_upload">
                <span class="upload_text">写真を追加</span>
            </label>
            <input class="input_file" type="file" id="file_upload" name="image">
            <label class="title_label" for="product_name">商品名</label>
            <input type="text" name="product_name" id="product_name" placeholder="Product name" value="">
            <label class="title_label" for="price">価格</label>
            <input type="text" name="price" id="price" placeholder="Price" value="">
            <label class="news_label" for="product_detil">商品説明</label>
            <textarea class="input_text" name="product_detil" id="product_detil" rows="5" placeholder="">
————————————————————
Size XL ( 着丈 x 身幅 x 袖丈 x 肩幅 )
78.5 x 70 x 60 x 63
Fabric ( Nylon 100% )
Model ( 179cm )
————————————————————
※USED商品ですので、写真と表記以外の傷や汚れがある場合がございます
中古の特性としてご理解下さい。
※画像と商品の色味が若干異なる場合がございます。予めご了承下さい。
            </textarea>
            <div class="button_area">
                <a href="/" class="login_page_button">戻る</a>
                <input type="submit" value="登録" class="signup_button">
            </div>
        </form>
    </div>
    <?php include_once __DIR__ . '/../../common/_footer.php' ?>
</body>

</html>
