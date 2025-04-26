<?php
session_start();
include "db_conn.php";  

if (isset($_SESSION['user_id'])) {
    // Xóa token trong database
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Xóa session
session_unset();
session_destroy();

// Xóa cookie remember_token
setcookie('remember_token', '', time() - 3600, "/");

// Chuyển về trang Login
header("Location: login.php");
exit;
?>
