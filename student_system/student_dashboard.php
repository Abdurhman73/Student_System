<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    die('غير مسموح لك بالدخول');
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Student Dashboard</title></head>
<body>
<h2>مرحبًا بك</h2>
<ul>
    <li><a href="my_profile.php">عرض بياناتي</a></li>
    <li><a href="my_grades.php">درجاتي</a></li>
    <li><a href="logout.php">تسجيل خروج</a></li>
</ul>
</body>
</html>
