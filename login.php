<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตัวอย่างการตรวจสอบข้อมูลผู้ใช้
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตัวอย่างข้อมูลล็อกอินที่ถูกต้อง (สามารถเปลี่ยนแปลงได้)
    if ($username == '1' && $password == '1') {
        $_SESSION['user'] = $username; // เก็บข้อมูลผู้ใช้ใน session
        header('Location: index.php'); // เมื่อเข้าสู่ระบบสำเร็จ จะกลับไปที่หน้า Home
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password: </label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
