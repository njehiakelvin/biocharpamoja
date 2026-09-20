<?php
// admin/delete_blog.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../assets/php/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $imgs = $conn->prepare("SELECT image_path FROM blog_images WHERE blog_id = ?");
    $imgs->bind_param("i", $id);
    $imgs->execute();
    $result = $imgs->get_result();
    while ($row = $result->fetch_assoc()) {
        $file = "../" . $row['image_path'];
        if (file_exists($file)) unlink($file);
    }
    $imgs->close();

    $del = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $del->bind_param("i", $id);
    $del->execute();
    $del->close();
}

header("Location: dashboard.php");
exit();
