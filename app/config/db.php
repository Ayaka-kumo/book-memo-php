<?php
$host = 'db';
$dbname = 'book_memo';
$user = 'user';
$pass = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit;
}
