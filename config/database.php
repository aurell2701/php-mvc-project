<?php
// Railway menyediakan MySQL variables otomatis
return [
    'host' => getenv('MYSQLHOST') ?: 'php-mvc-project-production-67e4.up.railway.app',
    'port' => getenv('MYSQLPORT') ?: '3306',
    'dbname' => getenv('MYSQLDATABASE') ?: 'railway',
    'username' => getenv('MYSQLUSER') ?: 'root',
    'password' => getenv('MYSQLPASSWORD') ?: 'NjVEoMVYjxrMXwuwfJsJJyVOczcSiATk',
    'charset' => 'utf8mb4'
];
