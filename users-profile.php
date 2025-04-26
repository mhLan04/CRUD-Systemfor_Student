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

// Lấy thông tin user
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mb-4">Profile</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-warning"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <!-- Form Update Profile -->
    <form class="shadow p-4 mb-5" action="req/users-edit-profile.php" method="post">
        <h4>Change Profile Info</h4>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <!-- Form Change Password -->
    <form class="shadow p-4" action="req/users-edit-password.php" method="post">
        <h4>Change Password</h4>

        <?php if (isset($_GET['perror'])): ?>
            <div class="alert alert-warning"><?= htmlspecialchars($_GET['perror']) ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['psuccess'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['psuccess']) ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" name="cpass" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_pass" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="cnew_pass" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
