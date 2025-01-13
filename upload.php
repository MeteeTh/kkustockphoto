<?php
include 'db_connection.php'; // เชื่อมต่อฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKU Stock Photo</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="login.php">Login</a></li>
            <?php else: ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>

<?php

// รับข้อมูลจากฟอร์ม
$category = $_POST['category'];
$images = $_FILES['images'];

// ตรวจสอบว่าได้เลือกไฟล์หลายไฟล์หรือไม่
if ($images['error'][0] == 0) {
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    // วนลูปเพื่ออัปโหลดแต่ละไฟล์
    for ($i = 0; $i < count($images['name']); $i++) {
        $original_filename = basename($images['name'][$i]); // ดึงชื่อไฟล์ต้นฉบับ
        $safe_filename = preg_replace("/[^a-zA-Z0-9\-\_\.]/", "", $original_filename); // ลบอักขระที่ไม่ปลอดภัย
        $target_dir = "uploads/" . $category . "/"; // สร้างโฟลเดอร์ตาม category

        // ตรวจสอบว่าโฟลเดอร์นั้นมีอยู่หรือไม่ ถ้าไม่มีก็สร้าง
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ใหม่
        }

        $target_file = $target_dir . $safe_filename;

        // ตรวจสอบว่ามีไฟล์ชื่อเดียวกันหรือไม่
        $file_counter = 1;
        while (file_exists($target_file)) {
            $file_name_without_ext = pathinfo($safe_filename, PATHINFO_FILENAME);
            $file_extension = pathinfo($safe_filename, PATHINFO_EXTENSION);
            $safe_filename = $file_name_without_ext . "_" . $file_counter . "." . $file_extension;
            $target_file = $target_dir . $safe_filename;
            $file_counter++;
        }

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ตรวจสอบประเภทไฟล์
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($images["tmp_name"][$i], $target_file)) {
                $datetime_digitized = "Not Available";
                $model = "Not Available";

                // ดึงข้อมูล EXIF (เฉพาะ JPG/JPEG)
                if (function_exists('exif_read_data') && in_array($imageFileType, ['jpg', 'jpeg'])) {
                    $exif_data = @exif_read_data($target_file);
                    if ($exif_data) {
                        $datetime_digitized = $exif_data['DateTimeOriginal'] ?? "Not Available";
                        $model = $exif_data['Model'] ?? "Not Available";
                    }
                }

                // บันทึกข้อมูลลงฐานข้อมูล
                $stmt = $conn->prepare("INSERT INTO images (filename, category, filepath, datetimedigitized, model) 
                                        VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $safe_filename, $category, $target_file, $datetime_digitized, $model);

                if ($stmt->execute()) {
                    echo "The file " . $safe_filename . " has been uploaded and metadata saved to the database.<br>";
                } else {
                    echo "Error uploading file: " . $safe_filename . ". Error: " . $stmt->error . "<br>";
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading the file: " . $safe_filename . ".<br>";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed. (File: " . $safe_filename . ")<br>";
        }
    }
} else {
    echo "No files selected or there was an error with the files.";
}

$conn->close();


// Debug
echo "<pre>";
print_r($_FILES);
echo "</pre>";
