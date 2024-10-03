<?php
// เริ่มต้น session
session_start();
// น าเข ้าไฟล์ admin_header.php
include 'admin_header.php';
// น าเขา้ไฟลท์ เี่ ชอื่ มตอ่ กับฐานขอ้มลู
include '../db.php';

// ตรวจสอบวา่ มขี อ้ ความส าเร็จใน session หรือไม่
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    // ลบข ้อความหลังจากแสดง
    unset($_SESSION['success_message']);
}
// ตรวจสอบวา่ มกี ารสง่ ค าคน้ หาหรอื ไม่
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // ดึงข ้อมูล Users โดยกรองตามค าค้นหา
    $sql = "SELECT * FROM users WHERE username LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$searchQuery%"]);
    $result = $stmt;
} else {
    // ดึงข ้อมูล Users ทั้งหมด
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Manage Users</h1>
        <!-- ฟอร์มค้นหา -->
        <form method="GET" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by Username" value="<?= htmlspecialchars($searchQuery) ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <!-- ปุ่ม Add User -->
        <div class="text-end mb-3">
            <a href="add_user.php" class="btn btn-success">Add User</a>
        </div>

        <!-- ตารางแสดงขอ้ มลู ผใู้ช ้-->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch()): ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-warning">Edit</a>

                            <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการ
ลบ?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php
    include '../partials/footer.php'; // เรยี กใชส้ ว่ นทา้ยมารวม
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></scri
        pt >
</body >
</html >