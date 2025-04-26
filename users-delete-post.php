<?php
session_start();
require_once 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "Missing post ID.";
  exit();
}

$post_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// Kiểm tra quyền sở hữu và xoá bài viết
$stmt = $conn->prepare("DELETE FROM post WHERE post_id = ? AND user_id = ?");
if ($stmt->execute([$post_id, $user_id])) {
  header("Location: users-manage-posts.php"); // điều hướng đúng trang quản lý
  exit();
} else {
  echo "Delete failed.";
}
?>
