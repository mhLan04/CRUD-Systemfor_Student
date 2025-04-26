<?php
session_start();
include('db_conn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Post ID missing.";
    exit();
}

$post_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

// Truy vấn bài viết
$stmt = $conn->prepare("SELECT * FROM post WHERE post_id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found or you don't have permission.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Edit Post</h2>
  <form action="req/users-post-update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['post_title']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Content</label>
      <textarea name="text" class="form-control" rows="6"><?= htmlspecialchars($post['post_text']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <input type="number" name="category" class="form-control" value="<?= $post['category'] ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Cover Image (optional)</label>
      <input type="file" name="cover" class="form-control">
      <small>Current: <?= htmlspecialchars($post['cover_url']) ?></small>
    </div>

    <button type="submit" class="btn btn-success">Update Post</button>
  </form>
</body>
</html>
