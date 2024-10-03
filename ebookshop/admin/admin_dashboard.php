<?php
// เริ่มต้น session
session_start();
// น าเข ้าไฟล์ admin_header.php
include 'admin_header.php';
?>
<div class="container mt-4">
    <h1>Admin Dashboard</h1>
    <p>ยินดีต้องรับสู้หน้า Dashboard สำหรับผู้ดูแล</p>
    <!-- ใสเ่ นื้อหาทตี่ อ้ งการในหนา้ Admin Dashboard -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage eBooks</h5>
                    <p class="card-text">จัดการ e-books ในระบบ</p>
                    <a href="manage_ebooks.php" class="btn btn-primary">Go</a>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Orders</h5>
                    <p class="card-text">ตรวจสอบคำสั่งซื้อจากลูกค้า</p>
                    <a href="manage_orders.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Payments</h5>
                    <p class="card-text">จัดการชำระเงิน</p>
                    <a href="manage_payments.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">จัดการผู้ใช้งานในระบบ</p>
                    <a href="manage_users.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../partials/footer.php'; // เรยี กใชส้ ว่ นทา้ยมารวม
?>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></s
    cript >