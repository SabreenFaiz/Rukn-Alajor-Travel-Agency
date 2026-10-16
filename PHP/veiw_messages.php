<?php
try {
    $db = new PDO("sqlite:" . __DIR__ . "/agency.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query(
        "SELECT id, name, email, message, created_at
         FROM messages
         ORDER BY id DESC"
    );

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("حدث خطأ أثناء قراءة الرسائل. تأكدي من قاعدة البيانات.");
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسائل وكالة ركن الأجور</title>
</head>
<body>

<h2>📩 الرسائل الواردة</h2>

<?php if (empty($messages)): ?>

    <p>ما في رسائل محفوظة لحد الآن.</p>

<?php else: ?>

    <?php foreach ($messages as $row): ?>
        <hr>
        <p><strong>رقم الرسالة:</strong>
            <?= (int)$row["id"] ?></p>

        <p><strong>الاسم:</strong>
            <?= htmlspecialchars($row["name"]) ?></p>

        <p><strong>البريد الإلكتروني:</strong>
            <?= htmlspecialchars($row["email"]) ?></p>

        <p><strong>الرسالة:</strong><br>
            <?= nl2br(htmlspecialchars($row["message"])) ?></p>

        <p><strong>التاريخ:</strong>
            <?= htmlspecialchars($row["created_at"] ?? "") ?></p>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
