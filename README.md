# ピリカスクプオリジナルアプリ

## 概要
古着販売をするアプリです

## データベースとユーザーの作成
CREATE USER IF NOT EXISTS org_admin IDENTIFIED BY '1234';
GRANT ALL ON org_app.* TO org_admin;


CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    post_code VARCHAR(7) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(12) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL,
    explanation TEXT NOT NULL,
    price INT NOT NULL,
    done BOOLEAN NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE IF NOT EXISTS news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    news TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE IF NOT EXISTS purchase_histories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    purchase_date DATETIME NOT NULL,
    user_id INT NOT NULL,
    total_price INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_purchase_histories_user_id
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS purchase_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    purchase_history_id INT NOT NULL,
    product_id INT NOT NULL,
    price INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_purchase_details_purchase_history_id
    FOREIGN KEY (purchase_history_id)
        REFERENCES purchase_histories(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_purchase_details_product_id
    FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);
