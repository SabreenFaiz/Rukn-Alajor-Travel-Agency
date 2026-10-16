<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("يرجى إنشاء الحساب من صفحة تسجيل الدخول.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (
    $name === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 8
) {
    exit("تأكد من إدخال الاسم والبريد الإلكتروني، وأن كلمة المرور لا تقل عن 8 أحرف.");
}

try {
    $check = $db->prepare(
        "SELECT id FROM users WHERE email = ?"
    );
    $check->execute([$email]);

    if ($check->fetch()) {
        exit("هذا البريد الإلكتروني مسجل من قبل. استخدم بريدًا آخر أو سجلي الدخول.");
    }

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users (name, email, password)
            VALUES (?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        $name,
        $email,
        $hashedPassword
    ]);

    session_regenerate_id(true);

    $_SESSION["user_id"] = $db->lastInsertId();
    $_SESSION["user_name"] = $name;

    header("Location: welcome.php");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("حدث خطأ أثناء إنشاء الحساب. حاول مرة أخرى.");
}
?>