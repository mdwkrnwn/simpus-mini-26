<?php

$config = require __DIR__ . '/config.php';
error_log('DB HOST CHECK: ' . ($config['db_host'] ?: 'EMPTY'));
error_log('DB USER CHECK: ' . ($config['db_user'] ?: 'EMPTY'));
$sslmode = getenv('DB_SSLMODE') ?: 'require';

// Validasi konfigurasi database
$required = [
    'db_host',
    'db_name',
    'db_user',
    'db_pass'
];

foreach ($required as $key) {
    if (empty($config[$key])) {
        error_log("Missing database configuration: {$key}");
        http_response_code(500);
        exit('Konfigurasi database belum lengkap.');
    }
}

try {

    $dsn = "pgsql:host={$config['db_host']};"
        . "port={$config['db_port']};"
        . "dbname={$config['db_name']};"
        . "sslmode={$sslmode};"
        . "connect_timeout=5";

    $pdo = new PDO(
        $dsn,
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]
    );

} catch (PDOException $e) {

    error_log('DATABASE ERROR: ' . $e->getMessage());

    http_response_code(500);

    exit('Koneksi database tidak tersedia.');
}