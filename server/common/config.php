<?php
// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=org_db;charset=utf8');
define('USER', 'org_admin');
define('PASSWORD', '1234');
define('EXTENTION', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('MSG_EMAIL_REQUIRED', 'メールアドレスが未入力です');
define('MSG_NAME_REQUIRED', 'ユーザー名が未入力です');
define('MSG_PASSWORD_REQUIRED', 'パスワードが未入力です');
define('MSG_POST_CODE_REQUIRED', '郵便番号が未入力です');
define('MSG_ADADDRESS_REQUIRED', '住所が未入力です');
define('MSG_PHONE_NUMBER_REQUIRED', '電話番号が未入力です');
define('MSG_EMAIL_DUPLICATE', 'そのメールアドレスは既に会員登録されています');
define('MSG_EMAIL_PASSWORD_NOT_MATCH', 'メールアドレスかパスワードが間違っています');
define('MSG_NO_DESCRIPTION', '詳細を入力してください');
define('MSG_NO_IMAGE', '画像を選択してください');
define('MSG_NO_NEWS_TITLE', 'NEWSタイトルを入力してください');
define('MSG_NOT_ABLE_EXT', '選択したファイルの拡張子が有効ではありません');
define('NEWS_NOTDELETE', 0);
define('MSG_NO_PRODUCTNAME', '商品名を入力してください');
define('MSG_NO_PRICE', '価格を入力してください');
define('MSG_NO_PRODUVCTDETAIL', '商品説明を入力してください');
define('PRODUCTS_SOLDOUT', 1);
