<?php
ob_start();
// Bắt đầu session
include('./config/show_dialog_message.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE['authData'])) {
    // Giải mã dữ liệu từ cookie
    $authData = json_decode($_COOKIE['authData'], true);

    // Kiểm tra xem thông tin có tồn tại và có vai trò không
    if ($authData && isset($authData['role'])) {
        // Kiểm tra vai trò của người dùng
        if ($authData['role'] !== 'ADMIN') {
            // Nếu không phải ADMIN, chuyển hướng về trang chính của người dùng
            header('Location: index.php?action=home');
            
            exit();
        }
    } else {
        // Nếu thông tin không hợp lệ, chuyển hướng về trang chính
        header('Location: index.php?action=home');
        exit();
    }
} else {
    // Nếu cookie không tồn tại, chuyển hướng về trang chính
    header('Location: index.php?action=login');
    exit();
}
function router(): void
{
    $action = $_POST['action'] ?? $_GET['action'] ?? 'home';

    switch ($action) {
        case 'home':
            include('admin/home.php');
            break;
        default:
            echo "<h1>404 - Page Not Found</h1>";
            break;
    }
}

include ('./header.php');
router();
showErrorMessage();
showSuccessMessage();
include './footer.php'; // Include footer
ob_end_flush(); // Gửi nội dung ra trình duyệt
