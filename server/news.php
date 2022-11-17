<?php

require_once __DIR__ . '/common/functions.php';


// セッション開始
session_start();

$current_user = '';
$news_notdelete = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}


// newsの取得
$news_notdelete = find_news_by_admin(NEWS_NOTDELETE);
$news_notdelete_reverse = array_reverse($news_notdelete);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
    <div class="news_container">
        <div class="items_photo">
            <img src="../images/48987212_.jpeg" alt="写真">
        </div>
        <h1 class="news_php_content">Events & News</h1>
        <div class="news_php_grid">
            <?php foreach ($news_notdelete_reverse as $news) : ?>
                <article class="news_php">
                    <a href="news_detail.php?id=<?= h($news['id']) ?>">
                        <div class="news_photo">
                            <img src="../images/<?= h($news['image']) ?>" alt="ニュース画像">
                        </div>
                        <div class="news_php_header">
                            <h3><?= h($news['name']) ?></h3>
                        </div>
                        <div class="news_day">
                            <?= h($news['created_at']) ?>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>
