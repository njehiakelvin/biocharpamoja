<?php
// !! DELETE THIS FILE IMMEDIATELY AFTER RUNNING IT !!
// Run once to bcrypt-hash your admin password in the DB.
// Visit: https://biocharpamoja.co.ke/run-once-rehash.php
include 'assets/php/db_connect.php';

$plain_password = "REPLACE_WITH_YOUR_CURRENT_PASSWORD"; // <-- change this first

$hashed = password_hash($plain_password, PASSWORD_BCRYPT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
$stmt->bind_param("s", $hashed);
$stmt->execute();

echo "Done. <strong>Delete this file now!</strong>";