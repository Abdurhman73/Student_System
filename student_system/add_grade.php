<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { die('غير مسموح'); }

if (isset($_POST['save'])) {
    $student = intval($_POST['student']);
    $course = intval($_POST['course']);
    $grade = intval($_POST['grade']);
    mysqli_query($conn, "INSERT INTO grades (student_id, course_id, grade) VALUES ($student,$course,$grade)");
    header('Location: add_grade.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar"><head><meta charset="UTF-8"><title>Add Grade</title></head><body>
<h2>إدخال درجة</h2>
<form method="POST">
    الطالب:
    <select name="student">
    <?php
    $q = mysqli_query($conn, "SELECT * FROM students");
    while ($s = mysqli_fetch_assoc($q)) {
        echo "<option value='{$s['id']}'>{$s['name']}</option>";
    }
    ?>
    </select><br><br>
    المادة:
    <select name="course">
    <?php
    $q = mysqli_query($conn, "SELECT * FROM courses");
    while ($c = mysqli_fetch_assoc($q)) {
        echo "<option value='{$c['id']}'>{$c['course_name']}</option>";
    }
    ?>
    </select><br><br>
    الدرجة: <input type="number" name="grade"><br><br>
    <button name="save">حفظ</button>
</form>
</body></html>
