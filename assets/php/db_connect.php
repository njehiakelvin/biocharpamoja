<?php
require_once 'config.php';

$conn = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

if ($conn->connect_error) {
    error_log("DB connection failed: " . $conn->connect_error);
    die('A database error occurred. Please try again later.');
}
