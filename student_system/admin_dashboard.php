<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die('غير مسموح لك بالدخول');
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Admin Dashboard</title></head>
<body>
<h2>لوحة تحكم المدير</h2>
<ul>
    <li><a href="manage_students.php">إدارة الطلاب</a></li>
    <li><a href="manage_users.php">إدارة المستخدمين</a></li>
    <li><a href="add_course.php">إضافة مادة</a></li>
    <li><a href="add_grade.php">إدخال درجة</a></li>
    <li><a href="logout.php">تسجيل خروج</a></li>
</ul>
</body>
</html>
