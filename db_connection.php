<?php
$host = 'localhost';
$username = 'root';
$password = '12345678';
$database = 'kkustockphoto_image';

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($host, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
