<?php
session_start();
include "../db_conn.php"; // Kết nối database

// Truy vấn tất cả tin nhắn
$stmt = $conn->prepare("SELECT * FROM contacts ORDER BY created_at DESC");
$stmt->execute();
$contacts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Contact Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Contact Messages</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact['id']) ?></td>
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($contact['message'])) ?></td>
                <td><?= htmlspecialchars($contact['created_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../blog.php" class="btn btn-secondary">Back to Blog</a>
</div>

</body>
</html>
