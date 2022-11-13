<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';

// セッション開始
session_start();

$current_user = '';
/* タスク更新処理
---------------------------------------------*/
$email = '';
$name = '';
$password = '';
$post_code = '';
$address = '';
$phone_number = '';

$errors = [];


if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $name = filter_input(INPUT_POST, 'name');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $phone_number = filter_input(INPUT_POST, 'phone_number');
    // バリデーション
    $errors = update_validate($email, $name, $post_code, $address, $phone_number);


    // エラーチェック
    if (empty($errors)) {
        
        update_task($email, $name, $post_code, $address, $phone_number);
        // index.php にリダイレクト
        header('Location: index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>

    <div class="signup_content">
        <h2 class="signup_title">設定変更</h2>
        <?php include_once __DIR__ . '/common/_errors.php' ?>
        <form class="signup_form" action="" method="post">
            <label class="email_label" for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= $current_user['email'] ?>">
            <label class="name_label" for="name">ユーザー名</label>
            <input type="text" name="name" id="name" placeholder="UserName" value="<?= $current_user['name'] ?>">
            <label class="password_label" for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" placeholder="Post_code" value="<?= $current_user['post_code'] ?>">
            <label class="password_label" for="address">住所</label>
            <input type="text" name="address" id="address" placeholder="Address" value="<?= $current_user['address'] ?>">
            <label class="password_label" for="phone_number">電話番号</label>
            <input type="tel" name="phone_number" id="phone_number" placeholder="Phone_number" value="<?= $current_user['phone_number'] ?>">
            <div class="button_area">
                <a href="/" class="login_page_button">戻る</a>
                <input type="submit" value="登録" class="signup_button">
            </div>
        </form>
    </div>

    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
