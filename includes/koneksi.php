<?php
$config = require __DIR__ . '/config.php';

$sslmode = getenv('DB_SSLMODE') ?: 'require';

try {
    $dsn = "pgsql:host={$config['db_host']};"
        . "port={$config['db_port']};"
        . "dbname={$config['db_name']};"
        . "sslmode={$sslmode}";

    $pdo = new PDO(
        $dsn,
        $config['db_user'],
        $config['db_pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Koneksi database tidak tersedia. Silakan coba kembali.');
}