<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$name = $_SESSION["user_name"] ?? "زائر";

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>مرحبًا بك - وكالة ركن الأجور</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>وكالة ركن الأجور للسفر والسياحة</h1>
        <p>رحلتك تبدأ معنا ✈️</p>
    </header>

    <main class="auth-container">

        <h2>
            مرحبًا بك يا
            <?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>
            ❤️
        </h2>

        <p>تم تسجيل الدخول بنجاح.</p>

        <a href="index.html">العودة إلى الرئيسية</a>

        <br><br>

        <a href="logout.php">تسجيل الخروج</a>

    </main>

</body>
</html>