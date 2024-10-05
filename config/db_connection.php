<?php
class DatabaseConnection
{
    private $host = 'mysql-8.0';           // Tên host của MySQL
    private $db_name = 'multiple-choice';   // Tên cơ sở dữ liệu
    private $username = 'root';             // Tên người dùng MySQL
    private $password = 'root';             // Mật khẩu MySQL
    public $connection;                     // Biến để lưu kết nối PDO

    // Constructor để tự động gọi hàm kết nối khi tạo đối tượng
    public function __construct()
    {
        $this->connect();  // Gọi hàm connect để kết nối cơ sở dữ liệu
    }

    // Phương thức kết nối đến cơ sở dữ liệu
    private function connect()
    {
        // Thiết lập cổng của MySQL, ví dụ cổng 3307
        $port = 3306; // Thay đổi cổng nếu cần

        // Chuỗi DSN chứa thông tin kết nối
        $dsn = "mysql:host={$this->host};port={$port};dbname={$this->db_name};charset=utf8mb4";

        try {
            // Khởi tạo kết nối PDO với MySQL
            $this->connection = new PDO($dsn, $this->username, $this->password);
            // Thiết lập chế độ báo lỗi cho PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Nếu có lỗi xảy ra, dừng chương trình và in ra lỗi
            // $exception = new ErrorCard("Database", "Can not connected");
            // $exception->display();
            die("Connection failed: " . $e->getMessage());
        }
    }


    // Phương thức trả về kết nối PDO
    public function getConnection()
    {
        return $this->connection;
    }
}

// Tạo đối tượng kết nối cơ sở dữ liệu
$db = new DatabaseConnection();
// Lấy kết nối PDO
$connection = $db->getConnection();
