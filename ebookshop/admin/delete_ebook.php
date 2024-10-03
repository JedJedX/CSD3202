<?php
// เริ่มต้น session
session_start();
// น าเขา้ไฟลท์ เี่ ชอื่ มตอ่ กับฐานขอ้มลู
include '../db.php';
// ตรวจสอบวา่ มกี ารสง่ คา่ ID ของ eBook มาหรือไม่
if (isset($_GET['id'])) {
$ebook_id = $_GET['id'];
// เตรยี มค าสงั่ SQL ส าหรับลบขอ้ มลู eBook
$sql = "DELETE FROM ebooks WHERE ebook_id = :ebook_id";
// เตรียม statement ส าหรับการลบ
$stmt = $conn->prepare($sql);
// ด าเนินการลบ eBook โดยสง่ ค่า ebook_id
if ($stmt->execute(['ebook_id' => $ebook_id])) {
// ลบส าเร็จ เก็บขอ้ ความส าเร็จใน session
$_SESSION['success_message'] = "eBook ถูกลบเรียบร ้อยแล้ว";
} else {
// ลบไมส่ าเร็จ เก็บขอ้ ความผดิ พลาดใน session
$_SESSION['error_message'] = "เกิดข ้อผิดพลาดในการลบ eBook";
}
}

// หลังจากลบเสร็จ กลับไปที่หน้า manage eBooks
header("Location: manage_ebooks.php");
exit();
?>