<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die('غير مسموح');
}

// حذف طالب (مع حذف المستخدم المرتبط إن وُجد)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM users WHERE student_id=$id");
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header('Location: manage_students.php');
    exit();
}

// إضافة / تعديل بسيط
if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dept = mysqli_real_escape_string($conn, $_POST['department']);
    if (!empty($_POST['student_id'])) {
        $sid = intval($_POST['student_id']);
        mysqli_query($conn, "UPDATE students SET name='$name', email='$email', phone='$phone', department='$dept' WHERE id=$sid");
    } else {
        mysqli_query($conn, "INSERT INTO students (name,email,phone,department) VALUES ('$name','$email','$phone','$dept')");
    }
    header('Location: manage_students.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Manage Students</title></head>
<body>
<h2>إدارة الطلاب</h2>
<h3>إضافة / تعديل طالب</h3>
<form method="POST">
    <input type="hidden" name="student_id" value=""><br>
    الاسم: <input type="text" name="name" required><br><br>
    الايميل: <input type="email" name="email"><br><br>
    الهاتف: <input type="text" name="phone"><br><br>
    القسم: <input type="text" name="department"><br><br>
    <button name="save_student" type="submit">حفظ</button>
</form>

<hr>
<h3>قائمة الطلاب</h3>
<table border="1" cellpadding="8">
<tr><th>ID</th><th>الاسم</th><th>الايميل</th><th>الهاتف</th><th>القسم</th><th>اجراء</th></tr>
<?php
$res = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>{$r['id']}</td>";
    echo "<td>{$r['name']}</td>";
    echo "<td>{$r['email']}</td>";
    echo "<td>{$r['phone']}</td>";
    echo "<td>{$r['department']}</td>";
    echo "<td><a href='manage_students.php?delete={$r['id']}'>حذف</a></td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>
