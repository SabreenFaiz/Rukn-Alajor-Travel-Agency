<?php

require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("افتحي صفحة التواصل وأرسلي الرسالة من النموذج.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $subject === "" || $message === "") {
    exit("يرجى ملء جميع الحقول.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("البريد الإلكتروني غير صحيح.");
}

try {
    $fullMessage = "الموضوع: " . $subject . "\n\n" . $message;

    $sql = "INSERT INTO contact_messages (name, email, message)
            VALUES (:name, :email, :message)";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":message" => $fullMessage
    ]);

    echo "تم حفظ الرسالة بنجاح ❤️";

} catch (PDOException $e) {
    http_response_code(500);
    echo "خطأ أثناء حفظ الرسالة: "
        . htmlspecialchars($e->getMessage(), ENT_QUOTES, "UTF-8");
}

?>
