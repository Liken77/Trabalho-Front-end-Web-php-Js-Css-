<?php
$host = getenv('DB_HOST') ?: 'localhost';
$port = (int) (getenv('DB_PORT') ?: 3306);
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db = getenv('DB_NAME') ?: 'webfinal';

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    error_log('Erro de conexão MySQL: ' . mysqli_connect_error());
    die('Não foi possível conectar ao banco de dados. Verifique a configuração e tente novamente.');
}

mysqli_set_charset($conn, 'utf8mb4');
