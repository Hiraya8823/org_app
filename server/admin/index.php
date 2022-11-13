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
<?php include_once __DIR__ . '/../common/head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <?php include_once __DIR__ . '/../common/_footer.php' ?>
</body>

</html>
