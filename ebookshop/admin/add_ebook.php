<?php
// เริ่มต้น session

session_start();
// น าเข ้าไฟล์ admin_header.php
include 'admin_header.php';
// include database connection from db.php
include '../db.php';
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $created_at = date('Y-m-d H:i:s');
        // File upload handling
        $image = $_FILES['image']['name']; // ระบชุ อื่ ฟิลดใ์หถ้กู ตอ้ ง
        $pdf_file = $_FILES['pdf_file']['name']; // ระบชุ อื่ ฟิลดใ์หถ้กู ตอ้ ง
// ตัง้คา่ เสน้ ทางอัปโหลดไฟลส์ าหรับรูปภาพและไฟล์PDF
        $image_target = "../images/" . basename($image);
        $pdf_target = "../pdfs/" . basename($pdf_file);
        // ย้ายไฟล์ไปยังโฟลเดอร์ปลายทาง
        move_uploaded_file($_FILES['image']['tmp_name'], $image_target);
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdf_target);
        // สร ้าง SQL ส าหรับการเพมิ่ ขอ้มลู ในฐานขอ้ มลู
        $sql = "INSERT INTO ebooks (name, description, image, pdf_file, price, created_at)
VALUES ('$name', '$description', '$image', '$pdf_file', '$price', '$created_at')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // ถา้เพมิ่ ขอ้มลู ส าเร็จ ใหต้ ัง้คา่ session message
        $_SESSION['success_message'] = "เพมิ่ ขอ้มูลหนังสอื ส าเร็จ";
        header("Location: manage_ebooks.php");
    }
} catch (PDOException $e) {
    // จัดการข ้อผิดพลาดด้วย PDOException
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add eBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Add New eBook</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="pdf_file" class="form-label">PDF File</label>
                <input type="file" class="form-control" id="pdf_file" name="pdf_file">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
    <!-- สว่ น footer -->
    <?php
    include '../partials/footer.php'; // สว่ น footer
    ?>
</body>

</html>