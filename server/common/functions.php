<?php
require_once __DIR__ . '/config.php';
// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
// エスケープ処理を行う関数
function h($str)
{
    // ENT_QUOTES: シングルクオートとダブルクオートを共に変換する。
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function signup_validate($email, $name, $password, $post_code, $address, $phone_number)
{

    $errors = [];

    // バリデーション
    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    if (empty($post_code)) {
        $errors[] = MSG_POST_CODE_REQUIRED;
    }

    if (empty($address)) {
        $errors[] = MSG_ADADDRESS_REQUIRED;
    }

    if (empty($phone_number)) {
        $errors[] = MSG_PHONE_NUMBER_REQUIRED;
    }

    if (
        empty($errors) &&
        check_exist_user($email)
    ) {
        $errors[] = MSG_EMAIL_DUPLICATE;
    }

    return $errors;
}

function insert_user($email, $name, $password, $post_code, $address, $phone_number)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            users
            (email, name, password, post_code, address, phone_number)
        VALUES
            (:email, :name, :password, :post_code, :address, :phone_number);
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $pw_hash, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function check_exist_user($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT 
        * 
    FROM 
        users 
    WHERE 
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}

function login_validate($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}

function find_user_by_email($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function find_user_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function user_login($user)
{
    $_SESSION['current_user']['id'] = $user['id'];
    $_SESSION['current_user']['name'] = $user['name'];
    $_SESSION['current_user']['admin'] = $user['admin'];
    $_SESSION['current_user']['password'] = $user['password'];
    $_SESSION['current_user']['post_code'] = $user['post_code'];
    $_SESSION['current_user']['address'] = $user['address'];
    $_SESSION['current_user']['phone_number'] = $user['phone_number'];
    $_SESSION['current_user']['email'] = $user['email'];
    header('Location: /index.php');

    exit;
}


// タスク更新時のバリデーション
function update_validate($email, $name, $post_code, $address, $phone_number, $current_user)
{

    $errors = [];

    // バリデーション
    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }

    if (empty($post_code)) {
        $errors[] = MSG_POST_CODE_REQUIRED;
    }

    if (empty($address)) {
        $errors[] = MSG_ADADDRESS_REQUIRED;
    }

    if (empty($phone_number)) {
        $errors[] = MSG_PHONE_NUMBER_REQUIRED;
    }
// 変更前のemailが同じの場合はセーフにしたい
    if (
        empty($errors) &&
        check_exist_user($email)
    ) {
        if ($current_user['email'] != $email) {
        $errors[] = MSG_EMAIL_DUPLICATE;
        }
    }
    return $errors;
}
// タスク更新
function update_user($id, $email, $name, $post_code, $address, $phone_number)
{
    // データベースに接続
    $dbh = connect_db();
    // $id を使用してデータを更新
    $sql = <<<EOM
    UPDATE
        users
    SET
        email = :email,
        name = :name,
        post_code = :post_code,
        address = :address,
        phone_number = :phone_number
    WHERE
        id = :id
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);
    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
    // プリペアドステートメントの実行
    $stmt->execute();
}
// news更新
function insert_validate($news, $news_title, $upload_file)
{
    $errors = [];

    if (empty($upload_file)) {
        $errors[] = MSG_NO_IMAGE;
    } else {
        if (check_file_ext($upload_file)) {
            $errors[] = MSG_NOT_ABLE_EXT;
        }
    }

    if (empty($news_title)) {
        $errors[] = MSG_NO_NEWS_TITLE;
    }

    if (empty($news)) {
        $errors[] = MSG_NO_DESCRIPTION;
    }

    return $errors;
}
function check_file_ext($upload_file)
{
    $err = false;

    $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
    if (!in_array($file_ext, EXTENTION)) {
        $err = true;
    }

    return $err;
}
function insert_news($image_name, $news, $news_title)
{
    $dbh = connect_db();

    $sql = <<<EOM
    INSERT INTO 
        news
        (name, image, news) 
    VALUES 
        (:name, :image, :news);
    EOM;
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':name', $news_title, PDO::PARAM_STR);
    $stmt->bindValue(':news', $news, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image_name, PDO::PARAM_STR);
    $stmt->execute();
}
//  タスク完了
function delete_news_by_id($id)
{
    // データベースに接続
    $dbh = connect_db();

    // $id を使用してデータを更新
    $sql = <<<EOM
    UPDATE
        news
    SET
        admin = 1
    WHERE
        id = :id
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // プリペアドステートメントの実行
    $stmt->execute();
}
// done に応じてレコードを取得
function find_news_by_admin($status)
{

    // データベースに接続
$dbh = connect_db();

/* タスク照会
---------------------------------------------*/
// done を抽出条件に指定してデータを取得
$sql = <<<EOM
SELECT
    *
FROM
    news
WHERE
    admin = :status;
EOM;

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// バインド(代入)するパラメータの準備
$status = 0;

$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->execute();

// 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// 受け取った id のレコードを取得
function find_news_by_id($id)
{
    // データベースに接続
    $dbh = connect_db();

    // $id を使用してデータを取得
    $sql = <<<EOM
    SELECT
        *
    FROM
        news
    WHERE
        id = :id;
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// タスク更新時のバリデーション
function update_news_validate($news, $news_title)
{

    $errors = [];

    // バリデーション

    if (empty($news_title)) {
        $errors[] = MSG_NO_NEWS_TITLE;
    }

    if (empty($news)) {
        $errors[] = MSG_NO_DESCRIPTION;
    }

    return $errors;
}
// newsアップデート
function update_news($id, $news, $news_title)
{
    // データベースに接続
    $dbh = connect_db();
    // $id を使用してデータを更新
    $sql = <<<EOM
    UPDATE
        news
    SET
        news = :news,
        name = :name
    WHERE
        id = :id;
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);
    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':news', $news, PDO::PARAM_STR);
    $stmt->bindValue(':name', $news_title, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();
}
// done に応じてレコードを取得
function find_news_by_admin_order_limit($status)
{
    // データベースに接続
$dbh = connect_db();

/* タスク照会
---------------------------------------------*/
// done を抽出条件に指定してデータを取得
$sql = <<<EOM
SELECT
    *
FROM
    news
WHERE
    admin = :status
ORDER BY id DESC
LIMIT 3;
EOM;

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// バインド(代入)するパラメータの準備
$status = 0;

$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->execute();

// 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// 商品登録機能
function insert_validate_product($upload_file, $product_name, $price, $product_detil)
{
    $errors = [];

    if (empty($upload_file)) {
        $errors[] = MSG_NO_IMAGE;
    } else {
        if (check_file_ext($upload_file)) {
            $errors[] = MSG_NOT_ABLE_EXT;
        }
    }

    if (empty($product_name)) {
        $errors[] = MSG_NO_PRODUCTNAME;
    }

    if (empty($price)) {
        $errors[] = MSG_NO_PRICE;
    }

    if (empty($product_detil)) {
        $errors[] = MSG_NO_PRODUVCTDETAIL;
    }

    return $errors;
}
function insert_product($image_name, $product_name, $price, $product_detil)
{
    $dbh = connect_db();

    $sql = <<<EOM
    INSERT INTO 
        products
        (name, price, image, explanation) 
    VALUES 
        (:name, :price, :image, :explanation);
    EOM;
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':name', $product_name, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    $stmt->bindValue(':explanation', $product_detil, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image_name, PDO::PARAM_STR);
    $stmt->execute();
}
// done に応じてレコードを取得
function find_prpduct_by_done($status)
{

    // データベースに接続
$dbh = connect_db();

/* タスク照会
---------------------------------------------*/
// done を抽出条件に指定してデータを取得
$sql = <<<EOM
SELECT
    *
FROM
    products
WHERE
    done = :status;
EOM;

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// バインド(代入)するパラメータの準備
$status = 0;

$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->execute();

// 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//  売り切れ登録
function delete_product_by_id($id)
{
    // データベースに接続
    $dbh = connect_db();

    // $id を使用してデータを更新
    $sql = <<<EOM
    UPDATE
        products
    SET
        done = 1
    WHERE
        id = :id
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // プリペアドステートメントの実行
    $stmt->execute();
}
// done に応じてレコードを取得
function find_prpduct_soldout_by_done($status)
{

    // データベースに接続
$dbh = connect_db();

/* タスク照会
---------------------------------------------*/
// done を抽出条件に指定してデータを取得
$sql = <<<EOM
SELECT
    *
FROM
    products
WHERE
    done = :status;
EOM;

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// バインド(代入)するパラメータの準備
$status = 1;

$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->execute();

// 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// 受け取った 商品のid のレコードを取得
function find_product_by_id($id)
{
    // データベースに接続
    $dbh = connect_db();

    // $id を使用してデータを取得
    $sql = <<<EOM
    SELECT
        *
    FROM
        products
    WHERE
        id = :id;
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function update_products_validate($product_name, $price, $product_detil)
{

    $errors = [];

    // バリデーション

    if (empty($product_name)) {
        $errors[] = MSG_NO_PRODUCTNAME;
    }

    if (empty($price)) {
        $errors[] = MSG_NO_PRICE;
    }

    if (empty($product_detil)) {
        $errors[] = MSG_NO_PRODUVCTDETAIL;
    }

    return $errors;
}
// newsアップデート
function update_produccts($id, $product_name, $price, $product_detil)
{
    // データベースに接続
    $dbh = connect_db();
    // $id を使用してデータを更新
    $sql = <<<EOM
    UPDATE
        products
    SET
        explanation = :explanation,
        name = :name,
        price = :price
    WHERE
        id = :id;
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);
    // パラメータのバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':explanation', $product_detil, PDO::PARAM_STR);
    $stmt->bindValue(':name', $product_name, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();
}
// index.php商品一覧
function find_products_by_done_order_limit($status)
{
    // データベースに接続
$dbh = connect_db();

/* タスク照会
---------------------------------------------*/
// done を抽出条件に指定してデータを取得
$sql = <<<EOM
SELECT
    *
FROM
    products
WHERE
    done = :status
ORDER BY id DESC
LIMIT 8;
EOM;

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// バインド(代入)するパラメータの準備
$status = 0;

$stmt->bindValue(':status', $status, PDO::PARAM_INT);
$stmt->execute();

// 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function insert_product_cart($id, $user_id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    INSERT INTO 
        carts
        (products_id, users_id) 
    VALUES 
        (:products_id, :users_id );
    EOM;
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':products_id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':users_id', $user_id, PDO::PARAM_INT);

    $stmt->execute();
}
