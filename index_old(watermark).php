<?php
session_start();
include 'db_connection.php';

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// คำสั่ง SQL สำหรับดึงข้อมูลรูปภาพและจัดเรียงตาม id
$query = "SELECT * FROM images";
if ($categoryFilter) {
    $query .= " WHERE category = '$categoryFilter'";
}


$result = mysqli_query($conn, $query);


// ฟังก์ชันในการเพิ่มลายน้ำให้กับภาพ
function addWatermark($imagePath, $watermarkPath)
{
    $image = imagecreatefromjpeg($imagePath);
    $watermark = imagecreatefrompng($watermarkPath);

    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    $watermarkNewWidth = $imageWidth * 0.30;
    $watermarkNewHeight = ($watermarkNewWidth / $watermarkWidth) * $watermarkHeight;

    $resizedWatermark = imagecreatetruecolor($watermarkNewWidth, $watermarkNewHeight);
    imagealphablending($resizedWatermark, false);
    imagesavealpha($resizedWatermark, true);
    imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $watermarkNewWidth, $watermarkNewHeight, $watermarkWidth, $watermarkHeight);

    $destX = $imageWidth - $watermarkNewWidth - 10;
    $destY = $imageHeight - $watermarkNewHeight - 10;

    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagecopy($image, $resizedWatermark, $destX, $destY, 0, 0, $watermarkNewWidth, $watermarkNewHeight);

    ob_start();
    imagejpeg($image);
    $imageData = ob_get_contents();
    ob_end_clean();

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
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">

</head>

<body>
    <!-- Navbar -->
    <header>
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
    </header>

    <section class="main-content">
        <h1>Welcome to KKU Stock Photo</h1>

        <!-- ฟอร์มอัปโหลด -->
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
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
            <input type="file" id="images" name="images[]" multiple required><br>

            <input type="submit" value="Upload Image">
        </form>

        <!-- Progress bar -->
        <progress id="progressBar" value="0" max="100" style="width: 100%;"></progress>
        <div id="uploadStatus"></div>


        <script src="upload.js"></script>

        <hr>

        <!-- กรองรูป -->
        <form action="index.php" method="GET">
            <label for="category">Select Category:</label>
            <select name="category" id="category">
                <option value="">All Categories</option>
                <option value="Nature">Nature</option>
                <option value="Urban">Urban</option>
                <option value="Portrait">Portrait</option>
                <option value="Architecture">Architecture</option>
                <option value="Animals">Animals</option>
                <option value="Other">Other</option>
            </select>
            <input type="submit" value="Filter">
        </form>


        <hr>
        <?php
        // $dir = 'images/';
        // $files = scandir($dir);

        // $ext_list = ['jpg', 'png', 'jpeg', 'gif'];

        // foreach ($files as $image_file) {
        //     $l = strtolower($image_file);
        //     $parse_file_name = explode(".", $l);
        //     $file_ext = end($parse_file_name);

        //     if (in_array($file_ext, $ext_list)) {
        //         $exif_data = exif_read_data($dir . $image_file);

        //         print "<pre>";
        //         print_r($exif_data);
        //         print "</pre>";

        //         $photos[] = [
        //             'FileName' => $exif_data['FileName'],
        //             'Model' => $exif_data['Model'],
        //             'ExposureTime' => $exif_data['ExposureTime'],
        //             'FNumber' => $exif_data['FNumber'],
        //             'ISOSpeedRatings' => $exif_data['ISOSpeedRatings'],
        //             'FocalLength' => $exif_data['FocalLength'],

        //         ];
        //     }
        // }
        // print "<pre>";
        // print_r($photos);
        // print "</pre>";

        ?>

        <div class="image-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="image-item">
                        <?php if (!isset($_SESSION['user'])): ?>
                            <?php
                            $watermarkPath = 'images/watermark.png';
                            $imageData = addWatermark($row['filepath'], $watermarkPath);
                            $encodedImage = base64_encode($imageData);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $encodedImage; ?>" alt="<?php echo htmlspecialchars($row['filename']); ?>" width="300" class="image" onclick="openModal(this)">
                        <?php else: ?>
                            <img src="<?php echo $row['filepath']; ?>" alt="<?php echo htmlspecialchars($row['filename']); ?>" width="300" class="image" onclick="openModal(this)">
                        <?php endif; ?>

                        <!-- <form action="download.php" method="post">
                            <input type="hidden" name="image_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Download Image</button>
                        </form> -->
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No images found.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Modal สำหรับการขยายรูป -->
    <div id="imageModal" class="modal" style="display: none;">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>


    <script>
        function openModal(img) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            modal.style.display = "flex";
            modalImg.src = img.src;
        }

        function closeModal() {
            const modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }

        // ปิด modal เมื่อคลิกนอกภาพ
        window.onclick = function(event) {
            const modal = document.getElementById("imageModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>


</body>

</html>