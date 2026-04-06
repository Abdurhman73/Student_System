<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { die('غير مسموح'); }

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    mysqli_query($conn, "INSERT INTO courses (course_name, course_code) VALUES ('$name','$code')");
    header('Location: add_course.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar"><head><meta charset="UTF-8"><title>Add Course</title></head><body>
<h2>إضافة مادة</h2>
<form method="POST">
    اسم المادة: <input type="text" name="name" required><br><br>
    كود المادة: <input type="text" name="code" required><br><br>
    <button name="save">حفظ</button>
</form>
<hr>
<h3>المواد الموجودة</h3>
<ul>
<?php
$res = mysqli_query($conn, "SELECT * FROM courses ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($res)) {
    echo "<li>{$r['course_name']} ({$r['course_code']})</li>";
}
?>
</ul>
</body></html>
