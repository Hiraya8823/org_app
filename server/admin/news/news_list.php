<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../common/config.php';

// セッション開始
session_start();

$current_user = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}


// 未完了タスクの取得
$news_notdelete = find_news_by_admin(NEWS_NOTDELETE);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../../common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/../../common/_header.php' ?>

    <div class="news_new_content">
        <h2 class="news_new_title">NEWS変更</h2>

        <ul>
            <?php foreach ($news_notdelete as $news) : ?>
                <li class="one-task">
                    <a href="" class="btn check-btn done-btn"><?= h($news['name']) ?></a>
                    <div class="btn-set">
                        <a href="" class="btn edit-btn"><i class="fa-solid fa-pencil"></i></a>
                        <a href="delete.php?id=<?= h($news['id']) ?>" class="btn delete-btn"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="news_list_button_area">
            <a href="/" class="news_list_button">戻る</a>
        </div>
    </div>

    <?php include_once __DIR__ . '/../../common/_footer.php' ?>
</body>

</html>
