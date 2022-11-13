<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';

// 変数の初期化
$email = '';
$name = '';
$password = '';
$post_code = '';
$address = '';
$phone_number = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $phone_number = filter_input(INPUT_POST, 'phone_number');

    $errors = signup_validate($email, $name, $password, $post_code, $address, $phone_number);
    if (
        empty($errors) &&
        insert_user($email, $name, $password, $post_code, $address, $phone_number)
    ) {
        header('Location: login.php');
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
        <h2 class="signup_title">新規ユーザー登録</h2>
        <?php include_once __DIR__ . '/common/_errors.php' ?>
        <form class="signup_form" action="" method="post">
            <label class="email_label" for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= h($email) ?>">
            <label class="name_label" for="name">ユーザー名</label>
            <input type="text" name="name" id="name" placeholder="UserName" value="<?= h($name) ?>">
            <label class="password_label" for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="Password" value="<?= h($name) ?>">
            <label class="password_label" for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" placeholder="Post_code" value="<?= h($post_code) ?>">
            <label class="password_label" for="address">住所</label>
            <input type="text" name="address" id="address" placeholder="Address" value="<?= h($address) ?>">
            <label class="password_label" for="phone_number">電話番号</label>
            <input type="tel" name="phone_number" id="phone_number" placeholder="Phone_number" value="<?= h($phone_number) ?>">
            <div class="button_area">
                <input type="submit" value="新規登録" class="signup_button">
                <a href="login.php" class="login_page_button">ログインはこちら</a>
            </div>
        </form>
    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
