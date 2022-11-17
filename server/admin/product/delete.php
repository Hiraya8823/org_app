<?php
require_once __DIR__ . '/../../common/functions.php';


// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// タスク完了処理の実行
delete_product_by_id($id);

// 後ほど ここに update_done_by_id関数を呼び出す処理を追記する

// index.php にリダイレクト
header('Location: product_list.php');

exit;
