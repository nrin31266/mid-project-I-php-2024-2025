window.onload = function() {
    // Lấy hộp thoại thông báo lỗi và thành công
    var errorDialog = document.querySelector('.error-dialog');
    var successDialog = document.querySelector('.success-dialog');

    // Hiển thị hộp thoại lỗi nếu tồn tại
    if (errorDialog) {
        errorDialog.classList.add('show-message-dialog'); // Sử dụng lớp show-message-dialog
        
        // Tự động ẩn sau 5 giây
        setTimeout(function() {
            errorDialog.classList.remove('show-message-dialog');
        }, 5000);
    }

    // Hiển thị hộp thoại thành công nếu tồn tại
    if (successDialog) {
        successDialog.classList.add('show-message-dialog'); // Sử dụng lớp show-message-dialog
        
        // Tự động ẩn sau 5 giây
        setTimeout(function() {
            successDialog.classList.remove('show-message-dialog');
        }, 5000);
    }
};
