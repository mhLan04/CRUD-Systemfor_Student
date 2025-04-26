<?php
session_start();
include('../db_conn.php');

if (
    isset($_POST['title']) &&
    isset($_FILES['cover']) &&
    isset($_POST['text']) &&
    isset($_POST['category'])
) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    if (empty($title)) {
        $em = "Title is required";
        header("Location: ../users-add-posts.php?error=$em");
        exit;
    }

    $image_name = $_FILES['cover']['name'];
    if (!empty($image_name)) {
        $image_size = $_FILES['cover']['size'];
        $image_temp = $_FILES['cover']['tmp_name'];
        $error = $_FILES['cover']['error'];

        if ($error === 0) {
            if ($image_size > 1300000) {
                $em = "Sorry, your file is too large.";
                header("Location: ../users-add-posts.php?error=$em");
                exit;
            }

            $image_ex = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $allowed_exs = ["jpg", "jpeg", "png"];

            if (in_array($image_ex, $allowed_exs)) {
                $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
                $image_path = '../upload/blog/' . $new_image_name;

                if (!is_dir('../upload/blog')) {
                    mkdir('../upload/blog', 0777, true);
                }

                move_uploaded_file($image_temp, $image_path);

                $sql = "INSERT INTO post(post_title, post_text, cover_url, category, user_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$title, $text, $new_image_name, $category, $user_id]);
            }
        }
    } else {
        $sql = "INSERT INTO post(post_title, post_text, category, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$title, $text, $category, $user_id]);
    }

    if ($res) {
        $sm = "Successfully Created!";
        header("Location: ../users-add-posts.php?success=$sm");
        exit;
    } else {
        $em = "Unknown error occurred";
        header("Location: ../users-add-posts.php?error=$em");
        exit;
    }
} else {
    header("Location: ../users-add-posts.php");
    exit;
}
?>
