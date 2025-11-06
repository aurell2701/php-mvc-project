<?php
// Railway menyediakan MySQL variables otomatis
return [
    'host' => getenv('MYSQLHOST') ?: 'mysql.railway.internal',
    'port' => getenv('MYSQLPORT') ?: '3306',
    'dbname' => getenv('MYSQLDATABASE') ?: 'railway',
    'username' => getenv('MYSQLUSER') ?: 'root',
    'password' => getenv('MYSQLPASSWORD') ?: 'NjVEoMVYjxrMXwuwfJsJJyVOczcSiATk',
    'charset' => 'utf8mb4'
];
