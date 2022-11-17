<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/common/functions.php';


// セッション開始
session_start();

$current_user = '';
$errors = [];
$news_db = [];

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// 受け取った id のレコードを取得
$news_db = find_news_by_id($id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>

    <div class="news_detail_content">
        <h1 class="news_new_title"><?= h($news_db['name']) ?></h1>
        <div class="news_detail_php">
            <img src="/images/<?= h($news_db['image']) ?>">
            <p class="textarea_p">
                <?= h($news_db['news']) ?>
            </p>
        </div>


    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
