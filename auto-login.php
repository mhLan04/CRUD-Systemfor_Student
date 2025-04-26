<?php
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    include_once "db_conn.php"; // hoặc "../db_conn.php" tùy vị trí file

    $token = $_COOKIE['remember_token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE remember_token = ?");
    $stmt->execute([$token]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
    }
}
