<?php
// Start the session to access session variables
session_start();

// Check if the admin session is active (i.e., 'admin_id' and 'username' are set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

    // Check if the 'title', 'cover' (file input), 'text', and 'category' fields are set in the POST data
    if (
        isset($_POST['title']) &&
        isset($_FILES['cover']) &&
        isset($_POST['text']) &&
        isset($_POST['category'])
    ) {
        // Include the database connection file
        include('../../db_conn.php');

        // Retrieve values from the form
        $title = $_POST['title'];
        $text = $_POST['text'];
        $category = $_POST['category'];

        // Validate the 'title' field to ensure it is not empty
        if (empty($title)) {
            $em = "Title is required";
            header("Location: ../post-add.php?error=$em");
            exit;
        }

        // Retrieve the file (cover image) data from the POST request
        $image_name = $_FILES['cover']['name'];

        // Check if an image is provided
        if ($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];

            if ($error === 0) {
                if ($image_size > 1300000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: ../post-add.php?error=$em");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($image_ex, $allowed_exs)) {
                        $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
                        $image_path = '../../upload/blog' . $new_image_name;

                        move_uploaded_file($image_temp, $image_path);

                        $sql = "INSERT INTO post(post_title, post_text, cover_url, category) VALUES (?,?,?,?)";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$title, $text, $new_image_name, $category]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../post-add.php?error=$em");
                        exit;
                    }
                }
            }
        } else {
            // Nếu không có ảnh, vẫn lưu post với category
            $sql = "INSERT INTO post(post_title, post_text, category) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $text, $category]);
        }

        // Kiểm tra kết quả
        if ($res) {
            $sm = "Successfully Created!";
            header("Location: ../post-add.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: ../post-add.php?error=$em");
            exit;
        }
    } else {
        // Nếu thiếu dữ liệu bắt buộc
        header("Location: ../post-add.php");
        exit;
    }
} else {
    // Nếu không đăng nhập
    header("Location: ../admin-login.php");
    exit;
}
