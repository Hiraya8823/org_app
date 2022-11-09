<?php

// セッション開始
session_start();

$current_user = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php include_once __DIR__ . '/head.html' ?> 
<body>
    <?php include_once __DIR__ . '/_header.php' ?>
    






    <?php include_once __DIR__ . '/_footer.html' ?>
</body>
</html>
