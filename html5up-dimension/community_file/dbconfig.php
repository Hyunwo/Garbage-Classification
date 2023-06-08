<?php
$servername = '13.125.36.142';
$username = 'hyeonu';
$password = '1234';
$db = 'community';

try {
    $conn = new PDO("mysql:host=".$servername.";dbname=".$db, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    # echo "DB 연결 성공";
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}