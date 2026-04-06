<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die('غير مسموح');
}

// إنشاء مستخدم مرتبط بطالب
if (isset($_POST['create_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = MD5($_POST['password']); // demo
    $student_id = intval($_POST['student_id']);
    mysqli_query($conn, "INSERT INTO users (username,password,role,student_id) VALUES ('$username','$password','student',$student_id)");
    header('Location: manage_users.php');
    exit();
}

// حذف مستخدم
if (isset($_GET['deluser'])) {
    $uid = intval($_GET['deluser']);
    mysqli_query($conn, "DELETE FROM users WHERE id=$uid");
    header('Location: manage_users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head><meta charset="UTF-8"><title>Manage Users</title></head>
<body>
<h2>إدارة المستخدمين</h2>
<h3>إنشاء حساب لطالب</h3>
<form method="POST">
    اسم المستخدم: <input type="text" name="username" required><br><br>
    كلمة المرور: <input type="password" name="password" required><br><br>
    ربط بالطالب:
    <select name="student_id">
    <?php
    $q = mysqli_query($conn, "SELECT * FROM students");
    while ($s = mysqli_fetch_assoc($q)) {
        echo "<option value='{$s['id']}'>{$s['name']} (ID: {$s['id']})</option>";
    }
    ?>
    </select><br><br>
    <button name="create_user">إنشاء</button>
</form>

<hr>
<h3>قائمة المستخدمين</h3>
<table border="1" cellpadding="8">
<tr><th>ID</th><th>Username</th><th>Role</th><th>Student ID</th><th>Action</th></tr>
<?php
$res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>{$r['id']}</td>";
    echo "<td>{$r['username']}</td>";
    echo "<td>{$r['role']}</td>";
    echo "<td>{$r['student_id']}</td>";
    echo "<td><a href='manage_users.php?deluser={$r['id']}'>حذف</a></td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>
