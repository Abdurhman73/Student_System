<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') { die('غير مسموح'); }
$student_id = intval($_SESSION['student_id']);
$result = mysqli_query($conn, "SELECT courses.course_name, grades.grade FROM grades JOIN courses ON grades.course_id=courses.id WHERE grades.student_id=$student_id");
?>
<!DOCTYPE html>
<html lang="ar"><head><meta charset="UTF-8"><title>My Grades</title></head><body>
<h2>درجاتي</h2>
<table border="1" cellpadding="8">
<tr><th>المادة</th><th>الدرجة</th></tr>
<?php while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>{$row['course_name']}</td><td>{$row['grade']}</td></tr>";
} ?>
</table>
</body></html>
