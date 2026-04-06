<?php
include 'db_connect.php';
$msg = '';
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dept = mysqli_real_escape_string($conn, $_POST['department']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = MD5($_POST['password']); // demo only

    // insert student
    mysqli_query($conn, "INSERT INTO students (name, email, phone, department) VALUES ('$name', '$email', '$phone', '$dept')");
    $student_id = mysqli_insert_id($conn);

    // insert user
    mysqli_query($conn, "INSERT INTO users (username, password, role, student_id) VALUES ('$username', '$password', 'student', $student_id)");

    $msg = 'تم التسجيل بنجاح! يمكنك تسجيل الدخول الآن';
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Register</title></head>
<body>
<h2>تسجيل طالب جديد</h2>
<?php if ($msg) echo '<p style="color:green;">'.$msg.'</p>'; ?>
<form method="POST">
    الاسم: <input type="text" name="name" required><br><br>
    البريد: <input type="email" name="email"><br><br>
    الهاتف: <input type="text" name="phone"><br><br>
    القسم: <input type="text" name="department"><br><br>
    اسم المستخدم: <input type="text" name="username" required><br><br>
    كلمة المرور: <input type="password" name="password" required><br><br>
    <button type="submit" name="register">تسجيل</button>
</form>
<p><a href="login.php">العودة لتسجيل الدخول</a></p>
</body>
</html>
