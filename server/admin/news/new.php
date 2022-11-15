<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';

// セッション開始
session_start();

$current_user = '';
$news = '';
$news_title = '';
$upload_file = '';
$upload_tmp_file = '';
$errors = [];
$image_name = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 画像の説明文とタイトル
    $news = filter_input(INPUT_POST, 'news');
    $news_title = filter_input(INPUT_POST, 'news_title');
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    $errors = insert_validate($news, $news_title, $upload_file);

    if (empty($errors)) {
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../../images/' . $image_name;

        if (move_uploaded_file($upload_tmp_file, $path)) {
            insert_news($image_name, $news, $news_title);
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
        <h2 class="news_new_title">NEWS登録</h2>
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
            <label class="title_label" for="news_title">News タイトル</label>
            <input type="text" name="news_title" id="news_title" placeholder="News Title" value="">
            <label class="news_label" for="news">News</label>
            <textarea class="input_text" name="news" id="news" rows="5" placeholder="News内容"></textarea>
            <div class="button_area">
                <a href="/" class="login_page_button">戻る</a>
                <input type="submit" value="登録" class="signup_button">
            </div>

        </form>

    </div>



    <?php include_once __DIR__ . '/../../common/_footer.php' ?>
</body>

</html>
