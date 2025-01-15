<?php
session_start();
include 'db_connection.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าได้ล็อกอินหรือไม่
$isLoggedIn = isset($_SESSION['user']);

// ตรวจสอบว่ามีการส่ง image_id มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    $imageId = intval($_POST['image_id']);

    // ดึงข้อมูลภาพจากฐานข้อมูล
    $query = "SELECT * FROM images WHERE id = $imageId";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = $row['filepath'];
        $filename = $row['filename'];

        // เส้นทางของลายน้ำ
        $watermarkPath = 'images/watermark.png';

        // ตรวจสอบว่าไฟล์ภาพมีอยู่จริงหรือไม่
        if (file_exists($imagePath)) {
            // โหลดรูปภาพต้นฉบับ
            $image = imagecreatefromjpeg($imagePath);

            // โหลดลายน้ำ
            $watermark = imagecreatefrompng($watermarkPath);

            // ขนาดของลายน้ำ
            $watermarkWidth = imagesx($watermark);
            $watermarkHeight = imagesy($watermark);

            // ขนาดของรูปภาพต้นฉบับ
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

            // ปรับขนาดลายน้ำให้เหมาะสมกับภาพต้นฉบับ
            $resizeWatermark = true; // ปรับขนาดลายน้ำได้
            if ($resizeWatermark) {
                $watermarkNewWidth = $imageWidth * 0.30; // 30% ของขนาดภาพต้นฉบับ
                $watermarkNewHeight = ($watermarkNewWidth / $watermarkWidth) * $watermarkHeight;

                // ปรับขนาดลายน้ำ
                $resizedWatermark = imagecreatetruecolor($watermarkNewWidth, $watermarkNewHeight);
                imagealphablending($resizedWatermark, false);
                imagesavealpha($resizedWatermark, true);
                imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $watermarkNewWidth, $watermarkNewHeight, $watermarkWidth, $watermarkHeight);

                // อัปเดตตัวแปรลายน้ำ
                $watermark = $resizedWatermark;
                $watermarkWidth = $watermarkNewWidth;
                $watermarkHeight = $watermarkNewHeight;
            }

            // ปรับความโปร่งใสของลายน้ำ
            $transparency = 10; // ความโปร่งใส (0-127)
            imagefilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, $transparency);

            // คำนวณตำแหน่งของลายน้ำ
            $destX = $imageWidth - $watermarkWidth - 10;
            $destY = $imageHeight - $watermarkHeight - 10;

            // ตรวจสอบว่าไม่ได้ล็อกอินให้ใส่ลายน้ำ
            if (!$isLoggedIn) {
                imagealphablending($image, true);
                imagesavealpha($image, true);
                imagecopy($image, $watermark, $destX, $destY, 0, 0, $watermarkWidth, $watermarkHeight);
            }

            // ตั้งค่า header เพื่อให้เบราว์เซอร์รับรู้ว่าเป็นไฟล์ภาพ
            header('Content-Type: image/jpeg');

            // กำหนดชื่อไฟล์สำหรับดาวน์โหลด
            if (!$isLoggedIn) {
                $filename = pathinfo($filename, PATHINFO_FILENAME) . '_kkustockphoto.' . pathinfo($filename, PATHINFO_EXTENSION);
            }

            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // ส่งภาพไปที่เบราว์เซอร์
            imagejpeg($image);

            // ทำความสะอาดหน่วยความจำ
            imagedestroy($image);
            imagedestroy($watermark);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid image ID.";
    }
} else {
    echo "Invalid request.";
}
?>
