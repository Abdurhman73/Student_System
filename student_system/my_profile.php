<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') { die('غير مسموح'); }

$student_id = intval($_SESSION['student_id']);
if (!$student_id) { die('لا يوجد طالب مرتبط بحسابك'); }

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dept = mysqli_real_escape_string($conn, $_POST['department']);
    mysqli_query($conn, "UPDATE students SET name='$name',email='$email',phone='$phone',department='$dept' WHERE id=$student_id");
    header('Location: my_profile.php');
    exit();
}

$res = mysqli_query($conn, "SELECT * FROM students WHERE id=$student_id");
$data = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="ar"><head><meta charset="UTF-8"><title>My Profile</title></head><body>
<h2>ملفي الشخصي</h2>
<form method="POST">
    الاسم: <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>
    الايميل: <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>"><br><br>
    الهاتف: <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>"><br><br>
    القسم: <input type="text" name="department" value="<?= htmlspecialchars($data['department']) ?>"><br><br>
    <button name="update">حفظ التغييرات</button>
</form>
</body></html>
