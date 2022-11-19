<?php
require_once __DIR__ . '/common/functions.php';


// index.php から渡された id を受け取る
$id = filter_input(INPUT_GET, 'id');

// タスク完了処理の実行
delete_product_cart_by_id($id);


// index.php にリダイレクト
header('Location: product_cart.php');

exit;
