<?php
session_start();
require_once '../db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (
    isset($_POST['post_id']) &&
    isset($_POST['title']) &&
    isset($_POST['text']) &&
    isset($_POST['category'])
) {
    $post_id = (int) $_POST['post_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    // Get old cover image
    $stmt = $conn->prepare("SELECT cover_url FROM post WHERE post_id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
    $post = $stmt->fetch();

    if (!$post) {
        echo "Post not found.";
        exit();
    }

    // Check if a new image was uploaded
    if (!empty($_FILES['cover']['name'])) {
        $image_name = $_FILES['cover']['name'];
        $image_size = $_FILES['cover']['size'];
        $image_temp = $_FILES['cover']['tmp_name'];

        $image_ex = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_exs = ["jpg", "jpeg", "png", "webp"];

        if (in_array($image_ex, $allowed_exs)) {
            $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
            $image_path = "../upload/blog/" . $new_image_name;
            move_uploaded_file($image_temp, $image_path);

            // Delete old image if it exists and is not default
            if (!empty($post['cover_url']) && file_exists("../upload/blog/" . $post['cover_url'])) {
                unlink("../upload/blog/" . $post['cover_url']);
            }

            $sql = "UPDATE post SET post_title=?, post_text=?, category=?, cover_url=? WHERE post_id=? AND user_id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $text, $category, $new_image_name, $post_id, $user_id]);
        }
    } else {
        // No new image uploaded
        $sql = "UPDATE post SET post_title=?, post_text=?, category=? WHERE post_id=? AND user_id=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$title, $text, $category, $post_id, $user_id]);
    }

    if ($res) {
        header("Location: ../users-manage-posts.php?success=Post updated successfully.");
        exit();
    } else {
        echo "Update failed. Please try again.";
    }
} else {
    echo "Missing required post data.";
}
?>
