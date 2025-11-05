<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Railway akan otomatis menyediakan variabel ini:
        $config = [
            'host'     => getenv('MYSQLHOST') ?: 'localhost',
            'port'     => getenv('MYSQLPORT') ?: 3306,
            'dbname'   => getenv('MYSQLDATABASE') ?: 'mvc_db',
            'username' => getenv('MYSQLUSER') ?: 'root',
            'password' => getenv('MYSQLPASSWORD') ?: '',
            'charset'  => 'utf8mb4'
        ];

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tampilkan host & user agar lebih mudah debug (sementara aja)
            die("Connection failed: " . $e->getMessage() . "<br>Host: {$config['host']}<br>User: {$config['username']}");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}
    public function __wakeup() {}
}