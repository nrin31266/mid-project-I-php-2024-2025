<?php
class UserService
{
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    public function generateRandomId($length): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    public function addUser($username, $email, $password, $roleName = 'USER'): void
    {
        // Tạo ID ngẫu nhiên cho user
        $userId = $this->generateRandomId(30);

        // Bắt đầu transaction
        $this->connection->beginTransaction();

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 1. Kiểm tra xem username đã tồn tại hay chưa
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM `user` WHERE `username` = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // 2. Username đã tồn tại, rollback và thông báo lỗi
            // $this->connection->rollBack();
            throw new Exception("Username already exists!");
        }

        // 3. Username chưa tồn tại, thực hiện thêm người dùng
        $stmt = $this->connection->prepare("INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES (:id, :username, :email, :password, :role)");
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $roleName);
        $stmt->execute();

        // Commit transaction
        $this->connection->commit();
    }


    public function login($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT id, username, email, password, role 
                                             FROM user 
                                             WHERE username = :username");

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['password'])) {
            unset($result['password']);
            return $result;
        } else {
        }

        return false;
    }
}
