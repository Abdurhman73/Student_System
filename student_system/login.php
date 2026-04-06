<?php
session_start();
include 'db_connect.php';

$msg = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = MD5($_POST['password']); // demo; for production use password_hash()

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if ($result && mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['student_id'] = $data['student_id'];

        if ($data['role'] == 'admin') {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            header('Location: student_dashboard.php');
            exit();
        }
    } else {
        $msg = 'اسم المستخدم او كلمة المرور غير صحيحة';
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h2>تسجيل الدخول</h2>
<?php if ($msg) echo '<p style="color:red;">'.$msg.'</p>'; ?>
<form method="POST">
    اسم المستخدم: <input type="text" name="username" required><br><br>
    كلمة المرور: <input type="password" name="password" required><br><br>
    <button type="submit" name="login">تسجيل دخول</button>
</form>
<p>اذا لم يكن لديك حساب: <a href="register.php">سجل هنا</a></p>
</body>
</html>
