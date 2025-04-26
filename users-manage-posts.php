<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit;
}

include('db_conn.php');
include('inc/NavBar.php');

$sql = "SELECT * FROM post WHERE user_id = ? ORDER BY post_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2 class="mb-4">Your Posts</h2>
    <a href="users-add-posts.php" class="btn btn-primary mb-3">Add New Post</a>
    <?php if (empty($posts)): ?>
        <p>No posts found. Start by creating a new post.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Published</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['post_title']) ?></td>
                        <td><?= htmlspecialchars($post['category']) ?></td>
                        <td><?= $post['publish'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a href="users-edit-post.php?id=<?= $post['post_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="users-delete-post.php?id=<?= $post['post_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
