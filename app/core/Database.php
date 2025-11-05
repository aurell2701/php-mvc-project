<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Ambil environment variables (Railway + lokal)
        $config = [
            'host'     => getenv('MYSQL_HOST') ?: getenv('MYSQLHOST') ?: 'localhost',
            'port'     => getenv('MYSQL_PORT') ?: getenv('MYSQLPORT') ?: 3306,
            'dbname'   => getenv('MYSQL_DATABASE') ?: getenv('MYSQLDATABASE') ?: 'mvc_db',
            'username' => getenv('MYSQL_USER') ?: getenv('MYSQLUSER') ?: 'root',
            'password' => getenv('MYSQL_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: getenv('MYSQL_ROOT_PASSWORD') ?: '',
            'charset'  => 'utf8mb4'
        ];

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Jangan die() di Railway — kirim log aja
            error_log("DB Connection failed: " . $e->getMessage());
            error_log("Host: {$config['host']} | User: {$config['username']} | DB: {$config['dbname']} | Port: {$config['port']}");
            
            // Supaya gak crash di Railway (tapi tetap kasih info kalau di local)
            if (php_sapi_name() === 'cli-server' || getenv('RAILWAY_ENVIRONMENT')) {
                echo "<pre style='color:red'>Database connection error. Check Railway Variables.</pre>";
            }
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