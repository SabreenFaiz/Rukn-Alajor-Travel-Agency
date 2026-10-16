<?php
session_start();

require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("يرجى تسجيل الدخول من صفحة الموقع.");
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === "") {
    exit("يرجى إدخال البريد الإلكتروني وكلمة المرور.");
}

try {
    $stmt = $db->prepare(
        "SELECT id, name, email, password
         FROM users
         WHERE email = ?
         LIMIT 1"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        exit("الحساب غير موجود. تأكد من البريد الإلكتروني أو أنشئ حسابًا جديدًا.");
    }

    if (!password_verify($password, $user["password"])) {
        exit("كلمة المرور غير صحيحة. أدخل كلمة المرور التي استخدمتها عند إنشاء الحساب.");
    }

    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_name"] = $user["name"];

    header("Location: welcome.php");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("حدث خطأ في قاعدة البيانات. تأكد من إعدادات الاتصال وحاول مرة أخرى.");
}
?>