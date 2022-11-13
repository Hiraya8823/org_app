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
function update_task($id, $email, $name, $post_code, $address, $phone_number)
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
