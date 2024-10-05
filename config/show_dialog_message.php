<?php
// components.php
function showErrorMessage()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Hiển thị thông báo lỗi nếu tồn tại
    if (isset($_SESSION['error_message'])) {
        echo '
        <div class="message-dialog error-dialog">
            <p><img width="32" src="https://img.icons8.com/color/100/cancel--v1.png" alt="cancel--v1"/> ' . $_SESSION['error_message'] . '</p>
        </div>';
        // Sau khi hiển thị, xóa lỗi khỏi session để không hiển thị lại
        unset($_SESSION['error_message']);
    }
}

function showSuccessMessage()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Hiển thị thông báo thành công nếu tồn tại
    if (isset($_SESSION['success_message'])) { // Thay đổi biến session để phân biệt
        echo '
        <div class="message-dialog success-dialog">
            <p><img width="32" height="32" src="https://img.icons8.com/color/32/ok--v1.png" alt="ok--v1"/> ' . $_SESSION['success_message'] . '</p>
        </div>';
        // Sau khi hiển thị, xóa thành công khỏi session để không hiển thị lại
        unset($_SESSION['success_message']);
    }
}
