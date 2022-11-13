# ピリカスクプオリジナルアプリ

## 概要
古着販売をするアプリです

## データベースとユーザーの作成
CREATE DATABASE IF NOT EXISTS org_db;
CREATE USER IF NOT EXISTS org_admin IDENTIFIED BY '1234';
GRANT ALL ON org_db.* TO org_admin;

