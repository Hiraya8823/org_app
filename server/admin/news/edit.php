<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';


// セッション開始
session_start();

$current_user = '';
$errors = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// 受け取った id のレコードを取得
$news_db = find_news_by_id($id);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_title = filter_input(INPUT_POST, 'news_title');
    $news = filter_input(INPUT_POST, 'news');
    
    // バリデーション
    $errors = update_news_validate($news, $news_title);


    // エラーチェック
    if (empty($errors)) {

        update_news($id, $news, $news_title);
        // index.php にリダイレクト
        header('Location: news_list.php');
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
        <h2 class="news_new_title">NEWS変更</h2>
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
            <img src="../../images/<?= h($news_db['image']) ?>">
            <label class="title_label" for="news_title">News タイトル</label>
            <input type="text" name="news_title" id="news_title" placeholder="News Title" value="<?= h($news_db['name']) ?>">
            <label class="news_label" for="news">News</label>
            <textarea class="input_text" name="news" id="news" rows="5" placeholder="News内容" ><?= h($news_db['news']) ?></textarea>
            <div class="button_area">
                <a href="news_list.php" class="login_page_button">戻る</a>
                <input type="submit" value="登録" class="signup_button">
            </div>
        </form>

    </div>

    <?php include_once __DIR__ . '/../../common/_footer.php' ?>
</body>

</html>
