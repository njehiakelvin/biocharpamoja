<?php
// admin/setup_user.php
include '../assets/php/db_connect.php';

// CHANGE THESE DETAILS
$new_username = "admin";
$new_password = "password123"; 

// Hash the password (Security Best Practice)
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$new_username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Success!</h1>";
    echo "User: <strong>$new_username</strong> created.<br>";
    echo "Password: <strong>$new_password</strong><br>";
    echo "<a href='login.php'>Go to Login</a>";
} else {
    echo "Error: " . $conn->error;
}
?>