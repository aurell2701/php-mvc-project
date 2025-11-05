<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Railway biasanya menggunakan nama environment dengan underscore (_)
        // tapi kita tambahkan fallback agar tetap bisa dipakai di lokal.
        $config = [
            'host'     => getenv('MYSQLHOST') ?: getenv('MYSQL_HOST') ?: 'localhost',
            'port'     => getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: 3306,
            'dbname'   => getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'mvc_db',
            'username' => getenv('MYSQLUSER') ?: getenv('MYSQL_USER') ?: 'root',
            'password' => getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: getenv('MYSQL_ROOT_PASSWORD') ?: '',
            'charset'  => 'utf8mb4'
        ];

        // Debug (sementara, biar kita bisa lihat variabelnya kebaca atau nggak)
        echo "<pre>";
        print_r([
            'MYSQL_HOST' => getenv('MYSQL_HOST'),
            'MYSQLHOST' => getenv('MYSQLHOST'),
            'MYSQL_DATABASE' => getenv('MYSQL_DATABASE'),
            'MYSQLDATABASE' => getenv('MYSQLDATABASE'),
            'MYSQL_USER' => getenv('MYSQL_USER'),
            'MYSQLUSER' => getenv('MYSQLUSER'),
            'MYSQL_PASSWORD' => getenv('MYSQL_PASSWORD') ? '***SET***' : 'EMPTY',
            'MYSQLPASSWORD' => getenv('MYSQLPASSWORD') ? '***SET***' : 'EMPTY',
        ]);
        echo "</pre>";

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("
                <b>Connection failed:</b> {$e->getMessage()}<br>
                <b>Host:</b> {$config['host']}<br>
                <b>User:</b> {$config['username']}<br>
                <b>DB:</b> {$config['dbname']}<br>
                <b>Port:</b> {$config['port']}
            ");
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