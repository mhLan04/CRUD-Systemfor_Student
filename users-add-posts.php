<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}

include('db_conn.php');
include_once("./admin/data/Category.php");
include('inc/NavBar.php');

$categories = getAll($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/richtext.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/jquery.richtext.min.js"></script>
</head>
<body style="padding-top: 80px;">
<div class="container">
    <h3 class="mb-4">Create New Post</h3>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-warning"><?=htmlspecialchars($_GET['error'])?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?=htmlspecialchars($_GET['success'])?></div>
    <?php endif; ?>
    <form class="shadow p-4" action="req/users-post-create.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cover Image</label>
            <input type="file" name="cover" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="text" class="form-control text" rows="6" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <option value="" hidden>-- Select Category --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>">
                        <?= htmlspecialchars($category['category']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Post</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.text').richText();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>