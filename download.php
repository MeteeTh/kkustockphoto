<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    $imageId = intval($_POST['image_id']);
    $query = "SELECT * FROM images WHERE id = $imageId";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = $row['filepath'];
        $filename = $row['filename'];

        if (!file_exists($imagePath)) {
            die("File not found.");
        }

        // เพิ่ม `_kkustockphoto` ต่อท้ายชื่อไฟล์เสมอ
        $pathInfo = pathinfo($filename);
        $newFilename = $pathInfo['filename'] . '_kkustockphoto.' . $pathInfo['extension'];

        // ตั้งค่า header เพื่อดาวน์โหลดไฟล์
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $newFilename . '"');
        header('Content-Length: ' . filesize($imagePath));
        readfile($imagePath);
        exit;
    } else {
        die("Invalid image ID.");
    }
} else {
    die("Invalid request.");
}
