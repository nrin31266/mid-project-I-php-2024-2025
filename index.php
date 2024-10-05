<?php
ob_start();
include('./config/db_connection.php');
include('./service/user_service.php');
include('./config/show_dialog_message.php');

$userService = new UserService($connection);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function checkAuth(): string
{
    return isset($_COOKIE['authData']) ? 'home' : 'login';
}

function router(): void
{
    global $userService;
    $action = $_POST['action'] ?? $_GET['action'] ?? 'home';

    switch ($action) {
        case 'home':
            if (checkAuth() === 'login') {
                header('Location: index.php?action=login');
                exit();
            }
            include 'pages/home.php';
            break;
        case 'login':
            include 'pages/login.php';
            break;
        case 'sign_up':
            include 'pages/sign_up.php'; // Sửa lại tên file nếu cần
            break;
        case 'handle-sign-up':
            // Logic xử lý đăng ký người dùng
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $re_password = $_POST['re-password'] ?? '';

            // Kiểm tra mật khẩu
            if ($password !== $re_password) {
                $_SESSION['error_message'] = 'Passwords do not match!';
                include 'pages/sign_up.php';
                return;
            }

            try {
                $userService->addUser($username, $email, $password);
                header('Location: index.php?action=login');
                $_SESSION['success_message'] = "Sign up successfully!";
                exit();
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
                include 'pages/sign_up.php'; 
            }
            break;
        case 'handle-sign-in':
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userData = $userService->login($username, $password);

            if ($userData) {
                setcookie('authData', json_encode($userData), 0,"/");

                if ($userData['role']==='ADMIN'){
                    header('Location: index_admin.php');
                }else{
                    header('Location: index.php?action=home');
                } 
                $_SESSION['success_message'] = "Login successfully!";      
                exit();
            } else {
                $_SESSION['error_message']="Unauthenticated!";
                include 'pages/login.php';
            }
            break;
        default:
            echo "<h1>404 - Page Not Found</h1>";
            break;
    }
}

include './header.php';
// Include header
router();
showErrorMessage();
showSuccessMessage();
include './footer.php'; // Include footer
ob_end_flush(); // Gửi nội dung ra trình duyệt
