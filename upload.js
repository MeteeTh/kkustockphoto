document.getElementById('uploadForm').addEventListener('submit', function (e) {
    e.preventDefault(); // ป้องกันไม่ให้ฟอร์มทำการ submit แบบปกติ

    var formData = new FormData(this); // ใช้ FormData เพื่อดึงข้อมูลในฟอร์ม
    var xhr = new XMLHttpRequest(); // สร้าง XMLHttpRequest ใหม่

    xhr.open('POST', 'upload.php', true); // ส่งคำขอไปยัง upload.php

    // ฟังก์ชันอัพเดต progress bar
    xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) {
            var percent = (e.loaded / e.total) * 100; // คำนวณเปอร์เซ็นต์ที่อัปโหลดเสร็จ
            document.getElementById('progressBar').value = percent; // อัปเดต progress bar
            document.getElementById('uploadStatus').innerText = 'Uploading: ' + Math.round(percent) + '%'; // แสดงสถานะ
        }
    });

    // เมื่อการอัปโหลดเสร็จสิ้น
    xhr.onload = function () {
        if (xhr.status == 200) {
            // แสดงข้อความเมื่ออัปโหลดเสร็จ
            document.getElementById('uploadStatus').innerText = 'Upload complete!';
            var response = JSON.parse(xhr.responseText);
            alert('Uploaded ' + response.uploadedCount + ' files successfully!');
        } else {
            document.getElementById('uploadStatus').innerText = 'Upload failed!';
        }
    };

    // ส่งข้อมูล
    xhr.send(formData);
});
