<?php

$host = "127.0.0.1";
$port = "3306";
$username = "root";
$password = "root";
$database = "agency";

try {
    $db = new PDO(
        "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4",
        $username,
        $password
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "تم الاتصال بقاعدة البيانات بنجاح ❤️";

} catch (PDOException $e) {
    die("خطأ الاتصال: " . $e->getMessage());
}

?>