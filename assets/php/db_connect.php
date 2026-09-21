<?php
// assets/php/db_connect.php
require_once dirname(__DIR__, 2) . '/config/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    error_log("DB connection failed: " . $conn->connect_error);
    die('A database error occurred. Please try again later.');
}