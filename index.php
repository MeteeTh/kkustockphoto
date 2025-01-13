<?php
session_start();
include 'db_connection.php'; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลภาพจากฐานข้อมูล
$query = "SELECT * FROM images";
$result = mysqli_query($conn, $query);

// ฟังก์ชันในการเพิ่มลายน้ำให้กับภาพ
function addWatermark($imagePath, $watermarkPath)
{
    // โหลดภาพต้นฉบับ
    $image = imagecreatefromjpeg($imagePath);

    // โหลดลายน้ำ
    $watermark = imagecreatefrompng($watermarkPath);

    // ขนาดของลายน้ำ
    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);

    // ขนาดของภาพต้นฉบับ
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // ปรับขนาดลายน้ำให้เหมาะสม
    $watermarkNewWidth = $imageWidth * 0.30; // 30% ของขนาดภาพต้นฉบับ
    $watermarkNewHeight = ($watermarkNewWidth / $watermarkWidth) * $watermarkHeight;

    // สร้างลายน้ำใหม่ที่มีขนาดที่ปรับแล้ว
    $resizedWatermark = imagecreatetruecolor($watermarkNewWidth, $watermarkNewHeight);
    imagealphablending($resizedWatermark, false);
    imagesavealpha($resizedWatermark, true);
    imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $watermarkNewWidth, $watermarkNewHeight, $watermarkWidth, $watermarkHeight);

    // คำนวณตำแหน่งของลายน้ำ
    $destX = $imageWidth - $watermarkNewWidth - 10;
    $destY = $imageHeight - $watermarkNewHeight - 10;

    // แทรกลายน้ำลงในภาพ
    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagecopy($image, $resizedWatermark, $destX, $destY, 0, 0, $watermarkNewWidth, $watermarkNewHeight);

    // ส่งภาพที่ติดลายน้ำไปที่เบราว์เซอร์
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_contents();
    ob_end_clean();

    // ทำความสะอาดหน่วยความจำ
    imagedestroy($image);
    imagedestroy($watermark);

    return $imageData;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKU Stock Photo</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* เพิ่มสไตล์สำหรับการขยายรูปภาพ */
        .modal {
            display: none;
            /* ซ่อนกล่อง modal */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content,
        .close {
            position: relative;
        }

        .close {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 35px;
            font-weight: bold;
            color: white;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
    </style>
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
    <h1>Welcome to KKU Stock Photo</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="category">Select Category:</label>
        <select name="category" id="category">
            <option value="Nature">Nature</option>
            <option value="Urban">Urban</option>
            <option value="Portrait">Portrait</option>
            <option value="Architecture">Architecture</option>
            <option value="Animals">Animals</option>
            <option value="Other">Other</option>
        </select><br>

        <label for="image">Upload Image:</label>
        <input type="file" name="images[]" multiple required>
        <br>

        <input type="submit" value="Upload Image">
    </form>
    <br><br>
    <hr><br><br>

    <div class="image-container">
        <!-- แสดงรูปภาพ -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="image-item">
                    <!-- ถ้าไม่ได้ล็อกอิน จะทำการเพิ่มลายน้ำ -->
                    <?php if (!isset($_SESSION['user'])): ?>
                        <?php
                        // กำหนดเส้นทางของลายน้ำ
                        $watermarkPath = 'images/watermark.png';
                        $imageData = addWatermark($row['filepath'], $watermarkPath);
                        ?>
                        <!-- แสดงรูปที่มีลายน้ำ -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="<?php echo htmlspecialchars($row['filename']); ?>" width="300" class="image" onclick="openModal(this)">
                    <?php else: ?>
                        <!-- ถ้าล็อกอินแล้วให้แสดงภาพปกติ -->
                        <img src="<?php echo $row['filepath']; ?>" alt="<?php echo htmlspecialchars($row['filename']); ?>" width="300" class="image" onclick="openModal(this)">
                    <?php endif; ?>

                    <form action="download.php" method="post" onsubmit="event.preventDefault(); confirmDownload('<?php echo $row['filepath']; ?>', this)">
                        <input type="hidden" name="image_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Download Image</button>
                    </form>


                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>

    <!-- Modal สำหรับการขยายรูป -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
    <script>
        // ฟังก์ชันแจ้งเตือนขนาดภาพและขนาดไฟล์
        function confirmDownload(imagePath, form) {
            var image = new Image();
            image.onload = function() {
                var width = image.width;
                var height = image.height;
                fetch(imagePath)
                    .then(response => response.blob())
                    .then(blob => {
                        var sizeKB = Math.round(blob.size / 1024); // ขนาดไฟล์ใน KB
                        var userConfirmed = confirm('Image Dimensions: ' + width + 'x' + height + ' px\nFile Size: ' + sizeKB + ' KB\nDo you want to download this image?');
                        if (userConfirmed) {
                            form.submit(); // ถ้าผู้ใช้กดยืนยัน จะส่งฟอร์มเพื่อดาวน์โหลด
                        }
                    });
            };
            image.src = imagePath;
        }
  
        // ฟังก์ชันเปิด Modal
        function openModal(img) {
            var modal = document.getElementById("imageModal");
            var modalImg = document.getElementById("modalImage");
            modal.style.display = "block";
            modalImg.src = img.src; // ตั้งค่า src ของภาพใน modal เป็นภาพที่คลิก
        }

        // ฟังก์ชันปิด Modal
        function closeModal() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
    </script>
</body>

</html>