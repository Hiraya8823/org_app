<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../common/config.php';

// セッション開始
session_start();

$current_user = '';
$products_notdelete = '';
$product_notdelete_reverse = '';
$product_notdelete_reverse = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}


// 商品の取得
$products_notdelete = find_prpduct_by_done(NEWS_NOTDELETE);
$product_notdelete_reverse = array_reverse($products_notdelete);
// 売り切れ商品の登録
$products_soldout = find_prpduct_soldout_by_done(PRODUCTS_SOLDOUT)


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../../common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/../../common/_header.php' ?>

    <div class="product_new_content">
        <h2 class="news_new_title">商品一覧</h2>

        <ul>
            <?php foreach ($product_notdelete_reverse as $product_notdelete) : ?>
                <li class="product_one">
                    <img src="../../images/<?= h($product_notdelete['image']) ?>">
                    <a href="/../../product_detail.php?id=<?= h($product_notdelete['id']) ?>" class="btn check-btn done-btn product_one_a"><?= h($product_notdelete['name']) ?></a>
                    <div class="btn-set">
                        <a href="edit.php?id=<?= h($product_notdelete['id']) ?>" class="btn edit-btn"><i class="fa-solid fa-pencil"></i></a>
                        <a href="delete.php?id=<?= h($product_notdelete['id']) ?>" class="btn delete-btn"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
                <h2 class="product_soldout_title">売り切れ商品一覧</h2>
        <ul>
            <?php foreach ($products_soldout as $product_soldout) : ?>
                <li class="product_one">
                    <img src="../../images/<?= h($product_soldout['image']) ?>">
                    <a href="/../../product_detail.php?id=<?= h($product_soldout['id']) ?>" class="btn check-btn done-btn product_one_a"><?= h($product_soldout['name']) ?></a>
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

