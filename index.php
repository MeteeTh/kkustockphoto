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
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li><a href="login.php">Login</a></li>
                <?php else: ?>
                    <li><a href="logout.php">Logout</a></li>
                    <li class="login-status">Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</li>
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

        <div class="image-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="image-item">
                        <img src="<?php echo $row['filepath']; ?>" alt="<?php echo htmlspecialchars($row['filename']); ?>" width="300" class="image" onclick="openModal(this)">

                        <!-- เดี๋ยวเปลี่ยน ต้องทำให้เป็นแบบ hover แล้วแสดงปุ่มโหลด ทำแบบ มศว. -->
                        <form action="download.php" method="post" style="display:none">
                            <input type="hidden" name="image_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Download Image</button>
                        </form>
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