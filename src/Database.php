<?php

declare(strict_types=1);

final class Database
{
    public static function connect(): mysqli
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $host = getenv('DB_HOST') ?: 'localhost';
        $port = (int) (getenv('DB_PORT') ?: 3306);
        $database = getenv('DB_NAME') ?: 'stockflow';
        $user = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        $connection = new mysqli($host, $user, $password, $database, $port);
        $connection->set_charset('utf8mb4');

        return $connection;
    }
}

